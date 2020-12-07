<template>
    <div id="testsView">
        <div class="toolbox">
            <button
                class="btn btn-primary"
                @click="$modal.show('add-test')"
                v-if="$store.state.user != null && $store.state.user.role == 2"
            >
                <font-awesome-icon icon="plus" /> Utwórz Test
            </button>
        </div>
        <div class="mainView">
            <p :key="test.id" v-for="test in testy">{{ test.name }}</p>
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
                    class="form-control"
                />
                <datetime
                    :min-datetime="new Date().toISOString()"
                    type="datetime"
                    :phrases="{ ok: 'Ok', cancel: 'Anuluj' }"
                    v-model="test.start"
                    input-class="form-control"
                ></datetime>

                <input
                    type="number"
                    placeholder="Próg zdania"
                    min="0"
                    max="100"
                    class="form-control"
                    v-model="test.threshold"
                    id=""
                />
                <input
                    type="number"
                    placeholder="Czas na rozwiązanie testu"
                    min="1"
                    max="240"
                    class="form-control"
                    v-model="test.duration"
                    id=""
                />
                <select class="form-control" v-model="dzial"
                    ><option value="" disabled selected hidden
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
                    class="form-control"
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
            <button @click="createTest" class="btn btn-primary">
                Dodaj test
            </button>
        </modal>
    </div>
</template>
<script>
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";
import axios from "axios";
let ctx;
export default {
    components: {
        Datetime: Datetime
    },
    data() {
        return {
            test: {
                name: "",
                start: null,
                threshold: null,
                duration: null,
                students: []
            },
            dzialy: [],
            grupy: [],
            uczniowie: [],
            testy: [],
            grupa: null,
            dzial: null
        };
    },
    created() {
        this.getDzialy();
        this.getGrupy();
        this.getTests();
        ctx = this;
    },
    methods: {
        createTest: function() {

            axios
                .post("/api/add_test", {
                    name: this.test.name,
                    start: new Date(this.test.start).toISOString(),
                    threshold: this.test.threshold,
                    dzialy_id: this.dzial,
                    duration: this.test.duration,
                    students: this.test.students
                })
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log(res.data);
                    this.getTests();
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
                    this.testy = res.data
                });
        },
        getDzialy: function() {
            axios
                .get("/api/basic/dzialy")
                .catch(err => console.log(err.response))
                .then(res => {
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
                });
        }
    }
};
</script>
<style scoped>
#testsView{
    display: grid;
    grid-template-rows: 0.15fr 1.75fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}
</style>
