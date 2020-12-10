<template>
    <div id="main">
        <loading v-if="isLoading" />
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
                        <small v-if="myQuestion.session.teacher_test">{{ myQuestion.session.teacher_test.name}}</small>
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
            <div id="resulting">
                <results v-if="results && ilosc > 1" :data="results" />
            </div>
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
                ></button>
                <span style="width: 20px"></span>
                <button class="btn btn-primary" @click="getQuestion(dzial)">
                    {{ nextState }}
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
import Loading from "./Loading";
export default {
    props: {
        ilosc: {
            default: 40,
            type: Number
        },
        dzial: {
            default: 1,
            type: Number
        },
        test: {
            default: null,
            type: Number
        }
    },
    data() {
        return {
            myQuestion: [],
            answers: [],
            answered: [],
            results: null,
            deadline: null,
            sending: false,
            isLoading: true
        };
    },
    components: {
        question: Question,
        countdown: VueCountdown,
        results: Results,
        Loading: Loading
    },

    created() {
        this.getQuestion(this.dzial);
    },
    watch: {
        ilosc: function() {
            this.getQuestion(this.dzial);
        }
    },
    methods: {
        click: function() {
            if (this.answered.length == 0) {
                this.sending = true;
                this.answers = [];
                this.$refs.Question.forEach(element => {
                    element.sprawdzanie();
                });
            }
        },
        getQuestion: function() {
            this.isLoading = true;
            axios
                .get("/api/randQuestion", {
                    params: { dzial: this.dzial, amount: this.ilosc, test: this.test }
                })
                .catch(error => {console.log(error.response)})
                .then(res => {
                    this.myQuestion = res.data;
                    this.myQuestion.questions.forEach(item => {
                        item.odpowiedzi = this.shuffle(item.odpowiedzi);
                    });
                    this.answered = [];
                    this.results = null;
                    let deadline = new Date(this.myQuestion.session.deadline);
                    this.deadline = deadline - new Date();
                    this.isLoading = false;
                    window.scrollTo({ top: 0, behavior: "smooth" });
                });
        },
        oneAnswer: function(check) {
            this.answers.push(check);
            if (this.myQuestion.questions.length == this.answers.length) {
                this.sendAnswers();
            }
        },
        sendAnswers: function() {
            console.log(this.test)
            axios
                .post(
                    this.$store.state.user
                        ? "/api/saveAnswers"
                        : "/api/sendAnswers",
                    {
                        answers: this.answers,
                        session: this.myQuestion["session"]
                    },
                    {
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json"
                        }
                    }
                )
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    this.$refs.countdown.abort();
                    this.answered = res.data.answers;
                    this.results = res.data.results;
                    this.sending = false;
                    console.log(this.results);
                    // document.querySelector("").scrollIntoView();
                    window.scrollTo({ top: 0, behavior: "smooth" });
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

        shuffle: function(array) {
            // XD
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        },
        getCookie: function(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2)
                return parts
                    .pop()
                    .split(";")
                    .shift();
        }
    },
    computed: {
        buttonState: function() {
            if (this.sending) {
                return "Wysyłam...";
            } else if (this.ilosc > 1) {
                return "Zakończ";
            } else return "Sprawdź";
        },
        nextState: function() {
            if (this.ilosc <= 1) return "Następne pytanie";
            else return "Jeszcze raz";
        }
    }
};
</script>
<style scoped>
.button {
    padding-bottom:4vh;
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
</style>
