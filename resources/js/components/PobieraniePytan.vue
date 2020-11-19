<template>
  <div>
    <question
      ref="Question"
      :key="item.id"
      v-for="item in myQuestion"
      :zawartoscPytania="item"
    />
    <button class="btn btn-primary" @click="click">Wybierz</button>
    <select v-model="dzial" dzial id="">
      <option value="1">1</option>
      <option value="2">2</option>
    </select>
    <button class="btn btn-primary" @click="getQuestion(dzial)">Następne pytanie</button>
  </div>
</template>
<script>
import Question from "./Question";
import axios from "axios";
export default {
  methods: {
    click: function () {
      this.$refs.Question[0].sprawdzanie();
    },
    getQuestion: function () {
      axios
        .get("/api/randQuestion", { params: { dzial: this.dzial} })
        .catch((error) => {
          console.log(error.message);
        })
        .then((res) => {
          console.log(res);
          this.myQuestion = res.data;
        });
    },
  },
  components: {
    question: Question,
  },
  data() {
    return {
      myQuestion: [],
      dzial: 1
    };
  },
  created() {
    this.getQuestion(this.dzial);
  },
};
</script>