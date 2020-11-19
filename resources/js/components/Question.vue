<template>
  <div>
    <h1>{{ zawartoscPytania.tresc }}</h1>
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
</style>