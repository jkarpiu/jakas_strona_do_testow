<template>
  <div>
    <h1 class="questionH">{{ zawartoscPytania.tresc }}</h1>
    <div
      v-bind:key="odpowiedz.id"
      v-for="odpowiedz in zawartoscPytania.odpowiedzi"
    >
      <input
        v-model="check"
        name="odpowiedz"
        type="radio"
        :value="odpowiedz.id"
      />
      <label>{{ odpowiedz.tresc }}</label>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      check: " ",
    };
  },
  props: ["zawartoscPytania"],
  methods: {
    sprawdzanie: function () {
      console.log(this.check);
    },
  },
};
</script>
<style scoped>
    .questionH{
      text-align: center;
      margin-left: auto;
      margin-right: auto;
  }

    input {
      margin-top: 1vh;
      margin-left: 25vw;
    }
</style>