<template>
    <div>

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
