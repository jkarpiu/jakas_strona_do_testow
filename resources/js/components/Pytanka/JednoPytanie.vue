<template>
  <div>
    <div class="quiz">
      <li style=" margin-left: 3rem;  list-style-position: outside; list-style-type: decimal-leading-zero; font-size: 28px; ">
        <h1 class="questionH">{{ zawartoscPytania.tresc }}</h1>
      </li>
      <img class="image" :src="zawartoscPytania.image" alt="" />
      <div
        class="nothing-checked"
        v-if="this.answered != null && this.answered.zaznaczana.id == 1"
      >
        <p>Nie zaznaczono żadnej odpowiedzi!</p>
      </div>
      <ol type="A" style="list-style-type:inside; margin: 0; padding: 0">
        <div
          v-bind:key="odpowiedz.id"
          v-for="odpowiedz in zawartoscPytania.odpowiedzi"
        >
          <div
            class="ans"
            :style="calculateColor(odpowiedz.id)"
            @click="selectAnswer(odpowiedz.id)"
          >
            <li>
              <p style="margin: 0; padding: 0; margin-left: 5px">
                {{ odpowiedz.tresc }}
              </p>
            </li>
          </div>
        </div>
      </ol>
    </div>
    <div class="watermark"><p>ipies</p></div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      check: " ",
    };
  },
  props: ["zawartoscPytania", "answered"],
  methods: {
    selectAnswer: function (id) {
      this.check = id;
    },

    sprawdzanie: function () {
      this.$emit("data", {
        question: this.zawartoscPytania.id,
        answer: this.check != " " ? this.check : 1,
      });
    },
    calculateColor: function (id) {
      if (this.answered == null) {
        if (this.check == id) {
          return "background-color: #0061c9;";
        }
        return " ";
      } else if (
        this.answered.zaznaczana.id == 1 &&
        id == this.answered.poprawna.id
      ) {
        return "background-color: #007c02;";
      } else if (this.answered.poprawna.id == id) {
        return "background-color: #007c02;";
      } else if (
        !this.answered.zaznaczana.poprawna &&
        id == this.answered.zaznaczana.id
      ) {
        return "background-color: darkred;";
      }
    },
  },

};
</script>
<style scoped>
.quiz {
  max-width: 60%;
  margin-left: auto;
  margin-right: auto;
  color: rgb(230, 230, 230);
  background-color: rgb(39, 39, 39);
  padding: 15px;
  padding-bottom: 1.5rem;
}

.questionH {
  font-size: 28px;
  max-width: 60vw;
  padding-left: 0.5vw;
  padding-top: 1vh;
}

.image {
  margin-left: auto;
  margin-right: auto;
  display: block;
  margin-bottom: 1vh;
  max-width: 80%;
}

.ans {
  margin-top: 1.3rem;
  padding: 5px;
  font-size: 16px;
  padding-top: 0.8rem;
  padding-bottom: 0.7rem;
  padding-left: 2rem;
  border: solid 1px rgb(33, 33, 33);
  background: rgb(33, 33, 33);
  cursor: pointer;
  vertical-align: middle;
}

.ans > li {
  padding: 0;
  margin: 0;
}
.ans:hover {
  background: rgb(29, 29, 29);
  color: rgb(148, 148, 148);
  border: solid 1px #0061c9;
}

/* input {
      margin-top: 0.5vh;
      margin-left: 1vw;
      margin-bottom: 2vh;
  } */
.watermark {
  text-align: center;
  padding-top: 1rem;
  color: rgb(77, 77, 77);
}

.nothing-checked {
  margin-top: 1.3rem;
  color: rgb(231, 231, 231);
  background-color: #0061c9;
  padding: 1rem;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  font-size: 1.3rem;
}

.nothing-checked > p {
  padding: 0;
  margin: 0;
}
</style>
