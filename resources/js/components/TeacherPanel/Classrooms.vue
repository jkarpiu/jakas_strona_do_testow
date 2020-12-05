<template>
    <div id="classroomsView">
        <div class="toolbox">
            <button
                class="btn btn-primary"
                @click="$modal.show('add-classroom')"
            >
                <font-awesome-icon icon="plus" /> Utwórz grupe
            </button>
        </div>
        <div class="classrooms">
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Ilość osób</th>
                        <th>Zaproszenia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr :key="group.id" v-for="group in list">
                        <td>{{ group.name }}</td>
                        <td>12</td>
                        <td><button class="btn btn-primary"><font-awesome-icon icon="link" /> </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <modal
            name="add-classroom"
            styles="background-color: #191919; padding: 25px;"
            adaptive
        >
            <p>
                Nazwa:
                <input
                    type="text"
                    v-model="new_group_name"
                    name=""
                    id=""
                    class="form-control"
                />
                <button @click="createGroup" class="btn btn-primary">
                    Dodaj
                </button>
            </p>
        </modal>
    </div>
</template>
<script lang="ts">
import axios from "axios";
export default {
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
        getGroups: function async() {
            axios
                .get("/api/groups")
                .catch(err => console.log(err.response))
                .then((res: any) => {
                    this.list = res.data;
                });
        }
    },
    data() {
        return {
            new_group_name: "",
            list: []
        };
    },
    created() {
        this.getGroups()
    }
};
</script>
<style scoped>
#classroomsView {
    display: grid;
    grid-template-rows: 1fr 1fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}
</style>
