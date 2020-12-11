<template>
    <div id="classroomsView">
        <div class="toolbox">
            <button
                class="btn btn-primary btn-left"
                style= "margin:2vh;"
                @click="$modal.show('add-classroom')"
                v-if="$store.state.user != null && $store.state.user.role == 2"
            >
                <font-awesome-icon icon="plus" /> Utwórz grupe
            </button>
            <button
                class="btn btn-primary "
                style= "margin:2vh;"
                @click="$modal.show('join-classroom')"
                v-if="$store.state.user != null && $store.state.user.role == 1"
            >
                <font-awesome-icon icon="plus" /> Dołącz do grupy
            </button>
        </div>
        <div class="mainView">
            <groups :list="list" />
        </div>
        <modal
            name="add-classroom"
            styles="background-color: #191919; padding: 25px;"
            adaptive
        >
            <p>
                <input
                    type="text"
                    v-model="new_group_name"
                    name=""
                    placeholder="Nazwij swoje zajęcia"
                    id=""
                    class="form-control"
                />
                <button @click="createGroup" class="btn btn-primary btn-left">
                    Dodaj
                </button>
            </p>
        </modal>
        <modal
            name="join-classroom"
            styles="background-color: #191919; padding: 25px;"
            adaptive
        >
            <p>
                <input
                    placeholder="Kod zaproszenia"
                    type="text"
                    v-model.trim="$v.inv_code.$model"
                                    :class="{
                                        'is-invalid': $v.inv_code.$error
                                    }"
                    name=""
                    id=""
                    class="form-control"
                />
                <div v-if="errCode === 422">
                    <p>Już jesteś członkiem tej klasy</p>
                </div>
                <p>Chodzi o ośmioznakowy kod zaproszenia który podał ci nauczyciel</p>
                <button @click="joinGroup" class="btn btn-primary "
                                    :disabled="this.$v.inv_code.$invalid">
                    Dołącz
                </button>
            </p>
        </modal>
    </div>
</template>
<script>
import axios from "axios";
import Groups from "./Groups";
import {
    required,
    minLength,
    maxLength
} from "vuelidate/lib/validators"
export default {
    components: { Groups },
    methods: {
        createGroup: function async() {
            axios
                .post("/api/add_group", { name: this.new_group_name })
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    this.$modal.hide("add-classroom");
                    this.getGroups();
                });
        },
        joinGroup: function() {
            if (!this.$v.$invalid) {
            axios
                .post("/api/join_group", {code: this.inv_code})
                .catch(err => {
                    if(err.response.status == 422){
                        this.list = err.response.data
                        this.errCode = 422
                    }
                    console.log(err.response)})
                .then(res => {
                    this.errCode = null;
                    console.log(res)
                    this.$modal.hide('join-classroom')
                    this.list = res.data;
                });
            }
        },
        getGroups: function async() {
            axios
                .get("/api/groups")
                .catch(err => console.log(err.response))
                .then(res => {
                    console.log("test");
                    this.list = res.data;
                });
        }
    },
    data() {
        return {
            new_group_name: "",
            list: [],
            inv_code: '',
            errCode: null
        };
    },
    validations : {
        inv_code: {
            required,
            minLength: minLength(8),
            maxLength: maxLength(8)
        },
    },
    created() {
        this.getGroups();
    }
};
</script>
<style scoped>
#classroomsView {
    display: grid;
    grid-template-rows: 0.15fr 1.75fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}
.btn-left {
    margin-right: 2rem;
    margin-top: 1rem;
}

</style>
