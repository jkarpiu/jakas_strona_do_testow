<template>
    <div>
        <div class="questions">
            <!-- <vue-slick-carousel
                class="allCards"
                :arrows="true"
                :dots="true"
                :dotsClass="'dotsAddDzial'"
            > -->
                <div
                    v-for="question in questions"
                    class="oneCard"
                    :key="question.id"
                >
                    <h1 class="header1">Dodaj pytanie</h1>
                    <input
                        class="form-control question-input"
                        placeholder="Podaj treść pytania"
                        v-model="question.tresc"
                        type="text"
                        name="pytanie"
                    />
                    <input
                        type="file"
                        id="file"
                        @change="selectFile(question.id - 1)"
                        :ref="'file' + (question.id - 1)"
                    />
                    <br />
                    <h1 class="header2">Dodaj odpowiedzi</h1>
                    <div
                        id="head-answer-all"
                        :key="answer.id"
                        v-for="answer in question.answers"
                    >
                        <div id="answer-all">
                            <p class="check-valid">
                                Poprawna:
                                <input
                                    type="radio"
                                    v-model="answer.poprawna"
                                    name="valid"
                                    true-value="true"
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
                                        question.answers = question.answers.filter(
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
                            question.answers.push(defaultAnswer());
                            question.answers[question.answers.length - 1].id =
                                question.answers.length;
                        "
                    >
                        Dodaj odpowiedź</button
                    ><button
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
                        Usuń pytanie
                    </button>
                </div>
                <button class="btn btn-success" @click="addQuestion(); for (let i = 0; i< 3; i++ ){addAnswer(questions.length - 1)}">Dodaj pytanie</button>
            <!-- </vue-slick-carousel> -->
        </div>
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
         <section class="card-list">
 
      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Pytanie</h2>
        </header> 
        <div class="odpowiedzi">
            <ol type="A">
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
            </ol> 
        </div>
        <div class="card-author">
            <font-awesome-icon
                icon="user"
                style="font-size:2rem;"
            />
          <div class="author-name">
            <div class="author-name-prefix">Autor</div>
            Jeff Delaney
          </div>
        </div>
      </article>
            <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Pytanie</h2>
        </header> 
        <div class="odpowiedzi">
            <ol type="A">
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
            </ol> 
        </div>
        <div class="card-author">
            <font-awesome-icon
                icon="user"
                style="font-size:2rem;"
            />
          <div class="author-name">
            <div class="author-name-prefix">Autor</div>
            Jeff Delaney
          </div>
        </div>
      </article>
            <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Pytanie</h2>
        </header> 
        <div class="odpowiedzi">
            <ol type="A">
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
            </ol> 
        </div>
        <div class="card-author">
            <font-awesome-icon
                icon="user"
                style="font-size:2rem;"
            />
          <div class="author-name">
            <div class="author-name-prefix">Autor</div>
            Jeff Delaney
          </div>
        </div>
      </article>
            <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Pytanie</h2>
        </header> 
        <div class="odpowiedzi">
            <ol type="A">
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
                <header class="answers card-header" style="margin-top:2vh;">
                <li>ODPOWIEDZ1</li>
                </header>
            </ol> 
        </div>
        <div class="card-author">
            <font-awesome-icon
                icon="user"
                style="font-size:2rem;"
            />
          <div class="author-name">
            <div class="author-name-prefix">Autor</div>
            Jeff Delaney
          </div>
        </div>
      </article>

 </section>
    </div>
</template>
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
import axios from "axios";
export default {
    data() {
        return {
            questions: [],
            dzialTitle: null,

            defaultAnswer: function() {
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
        addQuestion: function() {
            this.questions.push({
                id: this.questions.length + 1,
                tresc: "",
                answers: [],
                image: null
            });
        },
        addAnswer: function(pyt) {
            this.questions[pyt].answers.push(this.defaultAnswer());
            this.questions[pyt].answers[
                this.questions[pyt].answers.length - 1
            ].id = this.questions[pyt].answers.length;
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
        selectFile(id) {
            let image = this.$refs["file" + id].files[0];
            const reader = new FileReader();
            reader.onload = e => {
                this.questions[id].imgae = e.target.result;
            };
            console.log(this.$refs.file0.files);
            reader.readAsBinaryString(image);
            // `files` is always an array because the file input may be in multiple mode
        }
    },
    created() {
        for (let i = 0; i < 3; i++) {
            this.addQuestion();
            for (let j = 0; j < 3; j++) {
                this.addAnswer(i);
            }
        }
    }
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&display=swap');



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
    box-shadow: inset 1px 1px 1px hsla(0,0%,100%,.25), inset -1px -1px 1px rgba(0,0,0,.25);
}

.card-list::-webkit-scrollbar-track {
    background: linear-gradient(90deg,#201c29,#201c29 1px,#17141d 0,#17141d);
}

.card:hover {
    transform: translateY(-1rem);
}

.card:hover~.card {
    transform: translateX(130px);
}

.card-header{
    border: 1px solid rgba(0, 0, 0, 0.281);
}

.answers li{
    margin-left:1vw;
    
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
    transition: .2s;
    box-shadow: -1rem 0 2rem #000;
}
.odpowiedzi {
    vertical-align: middle;

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
