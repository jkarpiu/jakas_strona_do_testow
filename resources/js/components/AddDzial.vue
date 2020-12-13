<template>
    <div v-if="currentQ != null">
        <div class="addfield" style="width:30vw;
                box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);
                -webkit-box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);
                -moz-box-shadow: -2px 5px 24px 11px rgba(0, 0, 0, 0.4);">
            <input
            type="text"
            placeholder="Nazwa działu"
            class="form-control"
            style="margin: 15px auto;"
            v-model="dzialTitle"
            />
        </div>
       <div class="container">
            <div class="row justify-content-center" style="padding-top: 3rem;">


           <div class="addfield">
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
            <div class="addphoto">
            <p>Dodaj zdjęcie:</p>
            <input type="file" id="file" />
            </div>
            </div></div>
    <div class="row justify-content-center">
            <div class="addfield" style="margin-top:2rem;">
            <h1 class="header2">Dodaj odpowiedzi</h1>
            <div
                id="head-answer-all"
                :key="answer.id"
                v-for="(answer, i) in questions[currentQ].answers"
            >
                <div id="answer-all">
                    <p class="check-valid">
                        Poprawna:
                        <input
                            type="radio"
                            @change="setCorrect(i)"
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
            <div class="row justify-content-center" style="padding-top: 1rem;">
            <button
                class="btn btn-success"
                @click="
                    questions[currentQ].answers.push(defaultAnswer());"
                     >
                Dodaj odpowiedź
            </button>
            </div>
            <!-- </vue-slick-carousel> -->
        </div></div></div>
            <a @click="addQuestion">
                <div class="przycisk">
                Dodaj pytanie
                </div>
            </a>
        <section class="card-list">
            <div
                v-for="(question, index) in questions"
                class="oneCard"
                :key="question.id"
                @click="currentQ = index"
            >
                <article class="card">
                    <header class="card-header"
                            >
                        <h2 style="min-height: 2.1rem;">{{ question.tresc }}</h2>
                    </header>
                    <div class="odpowiedzi">
                        <ol style="padding-left: 0; margin-right:0.1vw;" type="A">
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
    <div class="container">
    <div class="row justify-content-center" style="padding-top: 1rem;">
    <div style="padding-top: 1rem;">
        <button type="submit" @click="send" class="btn btn-primary" style="margin-bottom: 1rem;">
            Wyślij
        </button>

    </div>
    </div>
    </div>
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
        setCorrect: function(i ) {
            this.questions[this.currentQ].answers.forEach((element, index) => {
                if(index == i){
                    element.poprawna = true
                }else {
                    element.poprawna = false
                }
            });
        },
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
                return "margin-top: 2vh; background: rgb(41, 41, 41);";
            }
        },
        addQuestion: function() {
            this.questions.push(this.defaultQuestion());
            for(var x=0; x<4; x++){
            this.questions[this.questions.length - 1].answers.push(this.defaultAnswer());
            }
            this.currentQ = this.questions.length - 1;
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

.addfield {
    margin-right:auto;
    margin-left:auto;
    padding:1rem;
    background: rgb(39,39,39);
    color: #fcfcfc;
    margin-bottom: 2rem;
    max-width: 50vw;
    min-width:40vw;
}
.addphoto > p {
    margin-top:2rem;
    margin-bottom:1vh;
    padding:0;
}

.header2 {
    margin-top:0;
}
.card-list {
    display: flex;
    padding: 3rem;
    overflow-x: scroll;
}


.card-list::-webkit-scrollbar {
  width: 0.5vw;
}

.card-list::-webkit-scrollbar-track {
  background: rgb(25, 25, 25);
}

.card-list::-webkit-scrollbar-thumb {
  background-color: #012e5f;
  background-clip: content-box;
  border-radius: 3px;
}

.card-list::-webkit-scrollbar-thumb:hover {
  background-color: #014996;
}
.card:hover {
    transform: translateY(-1rem);
}

.card:hover ~ .card {
    transform: translateX(130px);
}

.card-header {
    background-color: rgb(41, 41, 41);
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
    border-radius: 14px;
    transition: 0.2s;
    box-shadow: -1rem 0 2rem #000;
}
.przycisk{
    font-size: 1.5rem;
    margin-top:8vh;
    align-items: center;
    text-align: center;
    background: #407ec0;
    justify-content: space-around;
    padding:1rem 3rem;
    z-index: 1;
    -webkit-box-shadow: 2px 2px 12px 1px rgba(0,0,0,0.6);
    box-shadow: 2px 2px 12px 1px rgba(0,0,0,0.6);
    cursor: pointer;
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
