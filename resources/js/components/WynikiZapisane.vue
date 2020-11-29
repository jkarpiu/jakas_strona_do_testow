<template>
  <div>
    <div class="wyniki_table" >
      <table>
          <thead>
            <tr>
              <th>Dzial</th> <th>Zdane</th> <th>Punkty</th> <th>Procent</th> <th>Czas wysłania</th> <th>Test</th>
            </tr>
          </thead>
            <tr :key="wynik.id" v-for="wynik in wyniki">
              <th>{{ wynik.dzial.nazwa }}</th> 
              <th>{{ wynik.passed }}</th> 
              <th>{{ wynik.points }} / {{ wynik.max_points }}</th> 
              <th>{{ wynik.percentage }}</th> 
              <th>{{ wynik.created_at }}</th>
              <th><button>{{ wynik.test }}</button></th>
            </tr>
      </table>
    </div>
  </div>
</template>
<style>
.wyniki_table {
  margin-top:2vh;
  box-shadow: -2px 1px 24px 2px rgba(0, 0, 0, 0.4);
  margin-left: auto;
  margin-right: auto;
  border: 4px solid rgb(39, 39, 39);
  background-color: rgb(39, 39, 39);
  width:800px;
  position: static;
  text-align: center;
  border-collapse: collapse;
}
.wyniki_table td, .wyniki_table th {
  white-space: pre;
  border: 3px solid rgb(39, 39, 39);
  padding: 0.4rem 40px;
}
.wyniki_table thead{
background-color: #0061c9;
}
</style>

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
              percentage: '62.5%',
              dzial: {
                id: 1,
                nazwa: "ee08",
              },
            },
            {
              passed: true,
              points: 25,
              max_points: 40,
              percentage: '62.5%',
              dzial: {
                id: 1,
                nazwa: "ee08",
              },
            },
            {
              passed: true,
              points: 25,
              max_points: 40,
              percentage: '62.5%',
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
       wyniki : [
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
          ],
    };
  },
  created() {
  },
};
</script>