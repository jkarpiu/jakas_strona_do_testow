<template>
    <div id="testsView" @focus="getDzialy">
        <div class="toolbox">
            <button
                class="btn btn-primary btn-left"
                @click="$modal.show('add-test')"
                v-if="$store.state.user != null && $store.state.user.role == 2"
            >
                <font-awesome-icon icon="plus" /> Utwórz Test
            </button>
        </div>
        <div class="mainView">
            <tests-lists :testy="testy" />
        </div>
        <modal
            name="add-test"
            styles="background-color: #191919; padding: 25px;"
            adaptive
            height="500"
            focusTrap
        >
            <p>
                <input
                    type="text"
                    v-model="test.name"
                    placeholder="Nazwij swój test"
                    name=""
                    id=""
                    class="form-control margin"
                />
                <datetime
                    :min-datetime="new Date().toISOString()"
                    type="datetime"
                    :phrases="{ ok: 'Ok', cancel: 'Anuluj' }"
                    v-model="test.start"
                    placeholder="Data i godzina"
                    :input-class="['form-control', 'margin']"
                ></datetime>
                <input
                    type="number"
                    placeholder="Ilość pytań"
                    min="1"
                    style="margin-top: 1rem;"
                    max="400"
                    class="form-control margin"
                    v-model="test.questionAmount"
                    id=""
                />
                <input
                    type="number"
                    placeholder="Próg zdania (%)"
                    min="0"
                    style="margin-top: 1rem;"
                    max="100"
                    class="form-control margin"
                    v-model="test.threshold"
                    id=""
                />
                <input
                    type="number"
                    placeholder="Czas na rozwiązanie testu (min)"
                    min="1"
                    max="720"
                    class="form-control margin"
                    v-model="test.duration"
                    id=""
                />
                <select
                    @click="getDzialy"
                    @change="checkAdd"
                    class="form-control margin"
                    v-model="dzial"
                    ><option value="null" disabled selected hidden
                        >Wybierz dział</option
                    >
                    <option value="-1">Dodaj dzial</option>
                    <option
                        :key="dzial.id"
                        v-for="dzial in dzialy"
                        :value="dzial.id"
                        >{{ dzial.nazwa }}</option
                    >
                </select>
                <select
                    class="form-control margin"
                    v-model="grupa"
                    @change="getStudents"
                >
                    <option value="null" disabled selected hidden
                        >Wybierz klase</option
                    >
                    <option
                        :key="grupa.id"
                        v-for="grupa in grupy"
                        :value="grupa.id"
                        >{{ grupa.name }}</option
                    ></select
                >
            </p>

            <div style="display: flex; flex-wrap: wrap;">
                <p
                    :key="uczen.id"
                    v-for="uczen in uczniowie"
                    style="padding-right: 10px;"
                >
                    <input
                        type="checkbox"
                        name=""
                        v-model="test.students"
                        :value="uczen.id"
                        id=""
                        :true-value="uczen.id"
                    />
                    {{ uczen.fname + " " + uczen.lname }}
                </p>
            </div>
            <button
                @click="createTest"
                class="btn btn-primary "
                style=" padding-top:1rem;"
            >
                <p v-if="!sending">Dodaj test</p>
                <p v-else>Wysyłanie...</p>
            </button>
        </modal>
    </div>
</template>
<script>
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";
import TestsLists from "./TestsLists";
import axios from "axios";
import moment from "moment";
import { required, minLength, between } from "vuelidate/lib/validators";
let ctx;
export default {
    components: {
        Datetime: Datetime,
        TestsLists: TestsLists
    },
    data() {
        return {
            test: {
                name: "",
                start: null,
                threshold: null,
                duration: null,
                students: [],
                questionAmount: null
            },
            dzialy: [],
            grupy: [],
            uczniowie: [],
            testy: [],
            grupa: null,
            dzial: null,
            sending: false
        };
    },
    created() {
        this.getDzialy();
        this.getGrupy();
        this.getTests();
        ctx = this;
    },
    validation: {
        grupa: {
            required
        },

        dzial: {
            required
        },
        test: {
            threshold: {
                required,
                between: between(1, 100)
            },
            start: {
                required
            },
            name: {
                required,
                minLength: minLength(3)
            },
            duration: {
                required,
                between: between(1, 720)
            },
            students: {
                required
            },
            questionAmount: {
                required,
                between: between(1, 720)
            },

        }

    },
    methods: {
        createTest: function() {
            this.sending = true;
            console.log(new Date(this.test.start));
            axios
                .post("/api/add_test", {
                    name: this.test.name,
                    start: moment(this.test.start).toISOString(),
                    threshold: this.test.threshold,
                    dzialy_id: this.dzial,
                    duration: this.test.duration,
                    students: this.test.students,
                    questionAmount: this.test.questionAmount,
                    group_id: this.grupa
                })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res);
                    this.test = {
                        name: "",
                        start: null,
                        threshold: null,
                        duration: null,
                        students: [],
                        questionAmount: null
                    };
                    this.dzial = null;
                    this.uczniowie = [];
                    this.getTests();
                    this.sending = false;
                    this.grupa = null;
                    this.$modal.hide("add-test");
                });
        },
        getTests: function() {
            axios
                .get("/api/list_tests")
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    console.log(res.data);
                    this.testy = res.data;
                });
        },
        getDzialy: function() {
            axios
                .get("/api/basic/dzialy")
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log("focu");
                    console.log(res.data);
                    this.dzialy = res.data;
                });
        },
        getGrupy: function() {
            axios
                .get("/api/groups")
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    this.grupy = res.data;
                });
        },
        getStudents: () => {
            axios
                .post("/api/list_students", { id: ctx.grupa })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    ctx.uczniowie = res.data;
                    ctx.uczniowie.forEach((element, index) => {
                        ctx.test.students[index] = element.id;
                    });
                });
        },
        checkAdd() {
            console.log(this.$router.resolve("/nowydzial"));
            if (this.dzial == -1) {
                window.open(this.$router.resolve("/nowydzial").href, "_blank");
            }
        }
    },
    mounted() {
        window.addEventListener("focus", this.getDzialy);
    }
};
</script>
<style scoped>
#testsView {
    display: grid;
    grid-template-rows: 3rem 1.75fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}

.margin {
    margin-bottom: 1rem;
}

.btn-left {
    margin: 2vh;
}
</style>
