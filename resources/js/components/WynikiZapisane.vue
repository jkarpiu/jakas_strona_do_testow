<template>

        <div class="wyniki_table">
            <table>
                <thead>
                    <tr>
                        <th>Dzial</th>
                        <th>Nauczyciel</th>
                        <th>Zdane</th>
                        <th>Punkty</th>
                        <th>Procent</th>
                        <th>Czas wysłania</th>
                        <th>Test</th>
                    </tr>
                </thead>
                <tr :key="wynik.id" v-for="wynik in wyniki">
                    <th>{{ wynik.dzial.nazwa }}</th>
                    <th v-if="wynik.teacher_test">{{  wynik.teacher_test.teacher.fname + " " + wynik.teacher_test.teacher.lname +  ": " +wynik.teacher_test.name }}</th> <th v-else> - </th>
                    <th>{{ wynik.passed ? "Tak" : "Nie" }}</th>
                    <th>{{ wynik.points }} / {{ wynik.max_points }}</th>
                    <th
                        v-html="
                            ((wynik.points / wynik.max_points) * 100).toFixed(
                                2
                            ) + ' %'
                        "
                    ></th>
                    <th>{{ sensownyCzas(wynik.created_at) }}</th>
                    <th>
                        <button>{{ wynik.test }}</button>
                    </th>
                </tr>
            </table>
        </div>

</template>
<style>
.wyniki_table table {
    box-shadow: -2px 1px 24px 2px rgba(0, 0, 0, 0.4);
    margin-left: auto;
    margin-right: auto;
    border: 5px solid rgb(39, 39, 39);
    background-color: rgb(39, 39, 39);
    width: 798px;
    position: static;
    text-align: center;
    border-collapse: collapse;
}
.wyniki_table td,
.wyniki_table th {
    white-space: pre;
    border: 3px solid rgb(39, 39, 39);
    padding: 0.4rem 40px;
}
.wyniki_table thead {
    background-color: #0061c9;
}
</style>

<script>
import axios from "axios";
export default {
    methods: {
        getWyniki: function() {
            console.log("test");
            axios
                .get("/api/wyniki")
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    console.log(res.data);
                    this.wyniki = res.data;
                });
        },
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
                ' ' +
                date.getHours() + ':' + date.getMinutes()
            );
        }
    },
    data() {
        return {
            wyniki: []
        };
    },
    mounted() {
        this.getWyniki();
    }
};
</script>
<style scoped>
    .wyniki_table {
        padding-top: 4rem;
    }
</style>
