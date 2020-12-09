<template>
    <div>
        <div class="questions">
            <div v-for="question in questions" :key="question.id">
                <h1 class="header1">Dodaj pytanie</h1>
                <input
                    class="form-control question-input"
                    placeholder="Pytanie"
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
                        <button
                            class="btn btn-danger"
                            style="height: 2.3rem; width: 2.3rem; margin-left: 20px;"
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
                <button
                    class="btn btn-success"
                    @click="
                        question.answers.push(defaultAnswer());
                        question.answers[question.answers.length - 1].id =
                            question.answers.length;
                    "
                >
                    Dodaj odpowiedź
                </button>
                <center></center>
            </div>
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
<style scoped>
.questions {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    height: 80vh;
}
.question {
    flex: 0 0 auto;
}
</style>
