<template>
  <div id="main">
    <div class="loading" v-if="!myQuestion.session">
      <FacebookLoader color="#0061c9" />
    </div>
    <div class="loaded" v-else>
      <div
        style="position: sticky; top: 0; z-index: 1"
        v-if="myQuestion.session"
      >
        <div class="testHeader">
          <span>
            <small>Test z zakresu: </small>
            <h2 style="margin-bottom: 0">
              {{ myQuestion.session.dzial.nazwa }}
            </h2>
          </span>
          <span>
              <small> Pozostało: </small>
            <h2>
              <countdown
                :transform="transform"
                ref="countdown"
                :time="deadline - 2000"
                @end="click"
              >
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
      <results v-if="results" :data="results"/>
      <ol style="margin: 0; padding: 0">
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
           v-html="buttonState"
        >
        </button>
        <span style="width: 20px"></span>
        <button class="btn btn-primary" @click="getQuestion(dzial)">
          {{ nextState}}
        </button>
      </div>
      
    </div>
  </div>
</template>
<script>
import Question from "./Pytanka/JednoPytanie";
import Results from "./Pytanka/Wyniki";
import axios from "axios";
import VueCountdown from "@chenfengyuan/vue-countdown";
import { FacebookLoader } from "vue-spinners-css";
export default {
  props: ["ilosc"],
  methods: {
    click: function () {
      if (this.answered.length == 0) {
        this.sending = true;
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
          this.results = null;
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
          this.$refs.countdown.abort();
          this.answered = res.data.answers;
          this.results = res.data.results;
          this.sending = false;
          console.log(this.results);
        });
    },
    transform(props) {
      Object.entries(props).forEach(([key, value]) => {
        const digits = value < 10 ? `0${value}` : value;

        const word = value < 2 ? key.replace(/s$/, "") : key;

        props[key] = `${digits}`;
      });

      return props;
    },

    
  },
  computed: {
      buttonState: function () {
        if (this.sending) {
          return "Wysyłam...";
        } else if (this.ilosc > 1) {
          return "Zakończ";
        } else return "Sprawdź";
      },
      nextState: function() {
        if(this.ilosc <= 1)
          return "Następne pytanie"
        else 
          return "Jeszcze raz"
        
      }
    },
  components: {
    question: Question,
    countdown: VueCountdown,
    loading: FacebookLoader,
    results: Results
  },
  data() {
    return {
      myQuestion: [],
      dzial: 1,
      answers: [],
      answered: [],
      results: null,
      deadline: null,
      sending: false,
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
  box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);
  -webkit-box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);
}

.watermark {
  text-align: center;
  padding-top: 1rem;
  color: rgb(77, 77, 77);
}

.loading {
  margin-left: auto;
  margin-right: auto;
  margin-top: 30vh;
  display: flex;
  justify-content: center;
}
</style>