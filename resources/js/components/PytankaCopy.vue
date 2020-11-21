<template>
  <div>
    <question
      ref="Question"
      :key="item.id"
      v-for="item in myQuestion['questions']"
      :zawartoscPytania="item"
      @answer="oneAnswer"
    />
    <button class="btn btn-primary" @click="click">Wybierz</button>
    <select v-model="dzial" dzial id="">
      <option value="1">1</option>
      <option value="2">2</option>
    </select>
    <button class="btn btn-primary" @click="getQuestion(dzial)">
      Następne pytanie
    </button>
  </div>
</template>
<script>
import Question from "./Question-copy";
import axios from "axios";
export default {
  methods: {
    click: function () {
      this.$refs.Question.forEach((element) => {
        element.sprawdzanie();
      });
    },
    getQuestion: function () {
      axios
        .get("/api/randQuestion", { params: { dzial: this.dzial, amount: 2 } })
        .catch((error) => {
          console.log(error.response);
        })
        .then((res) => {
          console.log(res);
          this.myQuestion = res.data;
        });
    },
    oneAnswer: function (check) {
      this.answers.push(check);
      console.log(this.answers);
      if (this.myQuestion.size == this.answers.size) {
        this.sendAnswers();
      }
    },
    sendAnswers: function () {
      axios
        .post("/api/sendAnswers", {
          'answers': this.answers,
          'session': this.myQuestion["ses sion"],
        })
        .catch((err) => {
          console.log(err.response);
        })
        .then((res) => {
          console.log(res.body);
        });
    },
  },
  components: {
    question: Question,
  },
  data() {
    return {
      myQuestion: [],
      dzial: 1,
      answers: [],
    };
  },
  created() {
    this.getQuestion(this.dzial);
  },
};
</script>