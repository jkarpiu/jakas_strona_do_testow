<template>
    <div v-if="tests">
        <div v-for="test in tests" :key="test.id">
            <router-link :to="'/test/' + test.id">
                <p>{{ test.name + "    " +  sensownyCzas(test.start)}}</p>
            </router-link>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: {
        group: {
            default: null,
            type: Number
        }
    },
    data() {
        return {
            tests: []
        };
    },
    methods: {
        sensownyCzas: function(sqlTime) {
            let date = new Date(sqlTime);
            let miesiace = [
                "stycznia",
                "lutego",
                "marca",
                "kwietnia",
                "maja",
                "czerwca",
                "lipca",
                "sierpnia",
                "września",
                "października",
                "listopada",
                "grudnia"
            ];
            return (
                date.getDate().toString() +
                " " +
                miesiace[parseInt(date.getMonth())] +
                " " +
                date.getFullYear() +
                " " +
                date.getHours() +
                ":" +
                date.getMinutes()
            );
        }
    },
    created() {
        axios
            .post("/api/upcoming_tests", { id: this.group })
            .catch(err => console.log(err.response))
            .then(res => {
                console.log(res);
                this.tests = res.data;
            });
    }
};
</script>
<style scoped></style>
