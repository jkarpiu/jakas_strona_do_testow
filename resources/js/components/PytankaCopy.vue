<template>
  <div>
    <question
      ref="Question"
      :key="item.id"
      v-for="(item, index) in myQuestion['questions']"
      :zawartoscPytania="item"
      :answered="answered[index]"
      @answer="oneAnswer"
    />
    <button class="btn btn-primary" :disabled="answered.length > 0" @click="click">Sprawdź</button>
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
      if (this.answered.length  == 0) {
        console.log(this.answered);
        this.answers = [];
        this.$refs.Question.forEach((element) => {
          element.sprawdzanie();
        });
      }
    },
    getQuestion: function () {
      axios
        .get("/api/randQuestion", { params: { dzial: this.dzial, amount: 2 } })
        .catch((error) => {})
        .then((res) => {
          console.log(res);
          this.myQuestion = res.data;
          this.answered = []
        });
    },
    oneAnswer: function (check) {
      this.answers.push(check);
      if (this.myQuestion.size == this.answers.size) {
        this.sendAnswers();
      }
    },
    sendAnswers: function () {
      axios
        .post(
          "/api/sendAnswers",
          {
            answers: this.answers.zaznaczana,
            session: this.myQuestion["session"],
          },
          {
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
            },
          }
        )
        .catch((err) => {
          console.log(err.response);
        })
        .then((res) => {
          console.log(res.data);
          this.answered = res.data;
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
      answered: [],
    };
  },
  created() {
    this.getQuestion(this.dzial);
  },
};
</script>