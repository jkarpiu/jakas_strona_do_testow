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
        <div class="mainView"></div>
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
                <select class="form-control"
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
                <p :key="uczen.id" v-for="uczen in uczniowie" style="padding-right: 10px;">
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
            grupa: null
        };
    },
    created() {
        this.getDzialy();
        this.getGrupy();
        ctx = this;
    },
    methods: {
        createTest: function() {
            axios.post("/api/add_test", this.test).catch((err)=> console.log(err.response)).then((res) => console.log(res.data));
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
