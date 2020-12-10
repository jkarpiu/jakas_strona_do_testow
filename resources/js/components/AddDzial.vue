<template>
    <div v-if="currentQ != null">
        <div class="questions">
            <!-- <vue-slick-carousel
                class="allCards"
                :arrows="true"
                :dots="true"
                :dotsClass="'dotsAddDzial'"
            > -->

            <h1 class="header1">Dodaj pytanie</h1>
            <input
                class="form-control question-input"
                placeholder="Podaj treść pytania"
                v-model="questions[currentQ].tresc"
                type="text"
                name="pytanie"
            />
            <input type="file" id="file" />
            <br />
            <h1 class="header2">Dodaj odpowiedzi</h1>
            <div
                id="head-answer-all"
                :key="answer.id"
                v-for="answer in questions[currentQ].answers"
            >
                <div id="answer-all">
                    <p class="check-valid">
                        Poprawna:
                        <input
                            type="radio"
                            v-model="answer.poprawna"
                            name="valid"
                            :value="true"
                        />
                    </p>
                    <input
                        class="form-control answer-input"
                        placeholder="Odpowiedź"
                        v-model="answer.tresc"
                        type="text"
                    />
                    <div>
                        <button
                            class="btn btn-danger"
                            style=""
                            @click="
                                questions[currentQ].answers = questions[currentQ].answers.filter(
                                    function(value, index, arr) {
                                        return value != answer;
                                    }
                                )
                            "
                        >
                            <font-awesome-icon icon="trash" />
                        </button>
                    </div>
                </div>
            </div>
            <button
                class="btn btn-success"
                @click="
                    questions[currentQ].answers.push(defaultAnswer());

                "
            >
                Dodaj odpowiedź
            </button>
            <button class="btn btn-success" @click="addQuestion">
                Dodaj pytanie
            </button>
            <!-- </vue-slick-carousel> -->
        </div>

        <section class="card-list">
            <div
                v-for="(question, index) in questions"
                class="oneCard"
                :key="question.id"
                @click="currentQ = index"
            >
                <article class="card">
                    <header class="card-header">
                        <h2>{{ question.tresc }}</h2>
                    </header>
                    <div class="odpowiedzi">
                        <ol style="padding-left: 0" type="A">
                            <header
                                :key="answer.id"
                                v-for="answer in question.answers"
                                class="answers card-header"
                                :style="setStyle(answer.poprawna)"
                            >
                                <li>{{ answer.tresc }}</li>
                            </header>
                        </ol>
                    </div>
                    <div
                        class="card-author"
                        style="display: grid; grid-template-columns: 1fr 1fr 0.5fr;"
                    >
                        <button
                            class="btn btn-danger"
                            @click="
                                questions = questions.filter(function(
                                    value,
                                    index,
                                    arr
                                ) {
                                    return value != question;
                                })
                            "
                        >
                            <font-awesome-icon icon="trash" />
                        </button>
                    </div>
                </article>
            </div>
        </section>
        <input
            type="text"
            placeholder="Nazwa działu"
            class="form-control"
            style="width:40vw; margin: 15px;"
            v-model="dzialTitle"
        />
        <button type="submit" @click="send" class="btn btn-primary">
            Wyślij
        </button>
    </div>
</template>
<script>
let ctx;
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
import axios from "axios";
export default {
    data() {
        return {
            questions: [],
            dzialTitle: "",
            currentQ: null,
            defaultQuestion: () => {
                return {
                    id: null,
                    tresc: "",
                    answers: []
                };
            },
            defaultAnswer: () => {
                return {
                    id: null,
                    tresc: "",
                    poprawna: false
                };
            }
        };
    },
    components: {
        VueSlickCarousel: VueSlickCarousel
    },
    methods: {
        send: function() {
            axios
                .post("/api/add_dzial", {
                    questions: this.questions,
                    title: this.dzialTitle
                })
                .catch(err => {
                    console.log(err.response);
                })
                .then(res => {
                    console.log(res.data);
                });
        },
        setStyle: function(poprawna) {
            if (poprawna) {
                return "margin-top: 2vh; background: #007c02";
            } else {
                return "margin-top: 2vh;";
            }
        },
        addQuestion: function() {
            this.questions.push(this.defaultQuestion());
        }
    },
    mounted() {
        this.addQuestion()
        this.currentQ = 0;
    }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&display=swap");

.card-list {
    display: flex;
    padding: 3rem;
    overflow-x: scroll;
}

.card-list::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}
.card-list::-webkit-scrollbar-thumb {
    background: #201c29;
    border-radius: 10px;
    box-shadow: inset 1px 1px 1px hsla(0, 0%, 100%, 0.25),
        inset -1px -1px 1px rgba(0, 0, 0, 0.25);
}

.card-list::-webkit-scrollbar-track {
    background: linear-gradient(
        90deg,
        #201c29,
        #201c29 1px,
        #17141d 0,
        #17141d
    );
}

.card:hover {
    transform: translateY(-1rem);
}

.card:hover ~ .card {
    transform: translateX(130px);
}

.card-header {
    border: 1px solid rgba(0, 0, 0, 0.281);
}

.answers li {
    margin-left: 1vw;
}

.card:not(:first-child) {
    margin-left: -130px;
}

.card {
    display: flex;
    position: relative;
    flex-direction: column;
    height: 500px;
    width: 400px;
    min-width: 300px;
    padding: 1.5rem;
    border-radius: 16px;
    transition: 0.2s;
    box-shadow: -1rem 0 2rem #000;
}
.odpowiedzi {
    vertical-align: middle;
    width: 100%;
    height: 400px;
    overflow-y: auto;
}
.card-author {
    position: relative;
    display: grid;
    grid-template-columns: 3rem 1fr;
    align-items: center;
    margin: 1rem 0 0;
}
.oneCard {
    width: 80vw;
}
.allCards {
    width: 80vw;
    margin-left: auto;
    margin-right: auto;
}
</style>
