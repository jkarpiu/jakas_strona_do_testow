<template>
    <div>
        <div class="questions">
            <vue-slick-carousel
                class="allCards"
                :arrows="true"
                :dots="true"
                :dotsClass="'dotsAddDzial'"
            >
                <div
                    v-for="question in questions"
                    class="oneCard"
                    :key="question.id"
                >
                    <h1 class="header1">Dodaj pytanie</h1>
                    <input
                        class="form-control question-input"
                        placeholder="Podaj treść pytania"
                        type="text"
                        name="pytanie"
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
                    </div> <button
                        class="btn btn-success"
                        @click="
                            question.answers.push(defaultAnswer());
                            question.answers[question.answers.length - 1].id =
                                question.answers.length;
                        "
                    >
                        Dodaj odpowiedź
                    </button>

                    </div
            ></vue-slick-carousel>
        </div>
        <input
            type="text"
            placeholder="Nazwa działu"
            class="form-control"
            style="width:40vw; margin: 15px;"
        />
        <button type="submit" class="btn btn-primary">
            Wyślij
        </button>
    </div>
</template>
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
export default {
    data() {
        return {
            questions: [],
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
                answers: []
            });
        },
        addAnswer: function(pyt) {
            this.questions[pyt].answers.push(this.defaultAnswer());
            this.questions[pyt].answers[
                this.questions[pyt].answers.length - 1
            ].id = this.questions[pyt].answers.length;
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
.oneCard {
    width: 80vw;
}
.allCards {
    width: 80vw;
    margin-left: auto;
    margin-right: auto;
}
</style>
