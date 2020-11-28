<template>
  <div id="main">
    <div style="position: sticky; top: 0; z-index: 1;" v-if="myQuestion.session">
      <div class="testHeader">
        <span>
          <small>Test z zakresu: </small>
          <h2 style="margin-bottom: 0">
            {{ myQuestion.session.dzial.nazwa }}
          </h2>
        </span>
        <span style="display: flex; flex-direction: column"
          ><span style="display: flex; justify-content: flex-end"
            ><small> Pozostało: </small></span
          >
          <h2>
            <countdown :transform="transform" :time="deadline - 1000" @end="click">
              <template slot-scope="props"
                >{{ props.hours }}:{{ props.minutes }}:{{
                  props.seconds
                }}</template
              >
            </countdown>
          </h2>
        </span>
      </div>
    </div>
    <ol style="margin: 0; padding: 0; ">
      <div class="watermark"><p>ipies</p></div>
      <question
        ref="Question"
        :key="item.id"
        v-for="(item, index) in myQuestion['questions']"
        :zawartoscPytania="item"
        :answered="answered[index]"
        @data="oneAnswer"
      />
    </ol>
    <div class="button">
      <button
        class="btn btn-primary"
        :disabled="answered.length > 0"
        @click="click"
      >
        Sprawdź
      </button>
      <span style="width: 20px"></span>
      <button class="btn btn-primary" @click="getQuestion(dzial)">
        Następne pytanie
      </button>
    </div>
  </div>
</template>
<script>
import Question from "./Question-copy";
import axios from "axios";
import VueCountdown from "@chenfengyuan/vue-countdown";
export default {
  props: ["ilosc"],
  methods: {
    click: function () {
      if (this.answered.length == 0) {
        this.answers = [];
        this.$refs.Question.forEach((element) => {
          element.sprawdzanie();
        });
      }
    },
    getQuestion: function () {
      axios
        .get("/api/randQuestion", {
          params: { dzial: this.dzial, amount: this.ilosc },
        })
        .catch((error) => {})
        .then((res) => {
          console.log(this.dzial);
          console.log(res.data);
          this.myQuestion = res.data;
          this.answered = [];
          let deadline = new Date(this.myQuestion.session.deadline);
          this.deadline = deadline - new Date();
        });
    },
    oneAnswer: function (check) {
      this.answers.push(check);
      if (this.myQuestion.questions.length == this.answers.length) {
        this.sendAnswers();
      }
    },
    sendAnswers: function () {
      axios
        .post(
          "/api/sendAnswers",
          {
            answers: this.answers,
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
    transform(props) {
      Object.entries(props).forEach(([key, value]) => {
        // Adds leading zero
        const digits = value < 10 ? `0${value}` : value;

        // uses singular form when the value is less than 2
        const word = value < 2 ? key.replace(/s$/, "") : key;

        props[key] = `${digits}`;
      });

      return props;
    },
  },
  components: {
    question: Question,
    countdown: VueCountdown,
  },
  data() {
    return {
      myQuestion: [],
      dzial: 1,
      answers: [],
      answered: [],
      deadline: null,
    };
  },
  created() {
    this.getQuestion(this.dzial);
  },
};
</script>
<style scoped>
.button {
  margin-left: auto;
  margin-right: auto;
  display: flex;
  justify-content: center;
}
#main {
  margin-left: auto;
  margin-right: auto;
}
.testHeader {
  padding: 15px;
  width: 60vw;
  margin-bottom: 0;
  margin-left: auto;
  margin-right: auto;
  background-color: rgb(39, 39, 39);
  display: flex;
  justify-content: space-between;
  box-shadow: -2px 5px 24px 11px rgba(0,0,0,0.4);
-webkit-box-shadow: -2px 5px 24px 11px rgba(0,0,0,0.4);
-moz-box-shadow: -2px 5px 24px 11px rgba(0,0,0,0.4);
}

.watermark {
  text-align: center;
  padding-top: 1rem;
  color: rgb(77, 77, 77);
}
</style>