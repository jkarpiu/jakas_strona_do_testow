<template>
    <div>
        <div v-if="$store.state.user != null && $store.state.user.role == 1">
            <loading v-if="isLoading" />
            <div v-else>
                <div v-if="!isTestStarted">
                    <h2>
                        {{ testInfo.name }}
                    </h2>
                    <p>Termin rozpoczęcia: {{ this.startTime }}</p>
                    <p>
                        Czas trwania: {{ testInfo.duration }}
                        {{ testInfo.duration < 5 ? "minuty" : "minut" }}
                    </p>
                    <p>
                        Nauczyciel: {{ testInfo.teacher.fname }}
                        {{ testInfo.teacher.lname }}
                    </p>
                    <button
                        :disabled="!canTestStart"
                        @click="startTest"
                        class="btn btn-primary"
                    >
                        Zaczynamy!
                    </button>
                </div>
                <pytanka
                    v-else
                    :ilosc="testInfo.questionsAmount"
                    :dzial="testInfo.dzialy_id"
                    :test="testInfo.id"
                />
            </div>
        </div>
        <div
            v-else-if="$store.state.user != null && $store.state.user.role == 2"
        >
            <div v-if="testInfo" class="wyniki_table">
                <table>
                    <thead>
                        <tr>
                            <th>Imie</th>
                            <th>Nazwisko</th>
                            <th>Punkty</th>
                            <th>Zdane</th>
                        </tr>
                    </thead>
                    <tr
                        :key="wynik.id"
                        v-for="wynik in testInfo.wyniki"
                        @click="$router.push('/test/' + test.id)"
                    >
                        <th>{{ wynik.user.fname }}</th>
                        <th>{{ wynik.user.lname }}</th>
                        <th>{{ wynik.points }} / {{wynik.max_points}} </th>
                        <th>{{ wynik.passed ? "Tak" : "Nie" }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import loading from "./Loading";
import Loading from "./Loading.vue";
import Pytanka from "./PytankaCopy";
import moment from "moment";
export default {
    props: ["id"],
    data() {
        return {
            isLoading: true,
            testInfo: null,
            canTestStart: false,
            isTestStarted: false,
            startTime: null
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
                    console.log(res.data);
                    this.testInfo = res.data;
                    this.startTime = new Date(
                        moment
                            .utc(this.testInfo.start)
                            .local()
                            .format("YYYY-MMM-DD h:mm A")
                    );
                    this.canTestStart =
                        new Date() >= this.startTime &&
                        new Date() <=
                            moment(this.startTime)
                                .add(this.testInfo.duration, "m")
                                .toDate();
                    this.isLoading = false;
                });
        },
        startTest: function() {
            console.log(this.testInfo.id);
            this.isTestStarted = true;
        }
    },
    components: {
        Loading: loading,
        Pytanka: Pytanka
    }
};
</script>
<style scoped></style>
