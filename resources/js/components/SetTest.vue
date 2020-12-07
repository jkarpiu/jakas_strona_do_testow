<template>
    <div>
        <loading v-if="isLoading" />
        <div v-else>
            <h2>
                {{ testInfo.name }}
            </h2>
            <p>
                Termin rozpoczęcia: {{ new Date(testInfo.start) }}
            </p>
            <p>
                Czas trwania: {{ testInfo.duration }}
                {{ testInfo.duration < 5 ? "minuty" : "minut" }}
            </p>
            <p>
                Nauczyciel: {{ testInfo.teacher.fname }}
                {{ testInfo.teacher.lname }}
            </p>
            <button :disabled="!canTestStart" class="btn btn-primary">Zaczynamy!</button>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import loading from "./Loading";
import Loading from "./Loading.vue";
import moment from "moment";
export default {
    props: ["id"],
    data() {
        return {
            isLoading: true,
            testInfo: null,
            canTestStart: false,
            isTestedStarted: false
        };
    },
    created() {
        this.getTestInfo();
    },
    methods: {
        getTestInfo: function() {
            axios
                .post("/api/test_info", { id: this.id })
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    this.testInfo = res.data;
                    this.isLoading = false;
                    let currentTime = new Date();
                    console.log(currentTime);
                    let startTime = new Date(this.testInfo.start);
                    this.canTestStart =
                        currentTime >= startTime &&
                        currentTime <=
                            moment(startTime)
                                .add(this.testInfo.duration, "m")
                                .toDate();
                    console.log(res.data);
                });
        }
    },
    components: {
        Loading: loading
    }
};
</script>
<style scoped></style>
