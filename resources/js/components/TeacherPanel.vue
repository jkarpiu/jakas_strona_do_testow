<template>
    <div id="mainTeacherPanel">
        <div>
            <div :key="dzial.id" v-for="dzial in dzialy">
                <router-link :to="dzial.link">
                    <p>{{ dzial.nazwa }}</p>
                </router-link>
            </div>
        </div>
        <div>
            <router-view></router-view>
        </div>

    </div>
</template>

<script lang="ts">
import Home from "./TeacherPanel/Home.vue";
import Classrooms from "./TeacherPanel/Classrooms.vue";
import axios from "axios";
export default {
    components: { Home, Classrooms },

    data() {
        return {
            state: 0,
            dzialy: [
                {
                    id: 1,
                    nazwa: "Panel",
                    link: "/teacher/home"
                },
                {
                    id: 2,
                    nazwa: "Moje grupy",
                    link: "/teacher/groups"
                }
            ]
        };
    },
    created(): any {

    }
};
</script>
>
<style>
#mainTeacherPanel {
    color: aliceblue;
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: 0.5fr 1.5fr;
}
</style>
