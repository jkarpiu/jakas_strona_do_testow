<template>
  <div>
    <div :key="wynik.id" v-for="wynik in wyniki">
      <p>
        Dzial: {{ wynik.dzial.nazwa }} Zdane: {{ wynik.passed }} Punkty:
        {{ wynik.points }} / {{ wynik.max_points }} czas wysłania {{ wynik.created_at }}
      </p>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  methods: {
    getWyniki: function () {
      console.log("test");
      axios
        .get("/api/wyniki")
        .catch((err) => {
          console.log(err);
        })
        .then((res) => {
          console.log(res.data);
          this.wyniki = [
            {
              passed: true,
              points: 25,
              max_points: 40,
              dzial: {
                id: 1,
                nazwa: "ee08",
              },
            },
            {
              passed: true,
              points: 25,
              max_points: 40,
              dzial: {
                id: 1,
                nazwa: "ee08",
              },
            },
            {
              passed: true,
              points: 25,
              max_points: 40,
              dzial: {
                id: 1,
                nazwa: "ee08",
              },
            },
          ];
        });
    },
  },
  data() {
    return {
      wyniki: [],
    };
  },
  created() {
  },
};
</script>