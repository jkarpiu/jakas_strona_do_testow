<template>
  <div>
    <h1>{{ zawartoscPytania.tresc }}</h1>
    <img :src="zawartoscPytania.image" alt="">
    <div
      v-bind:key="odpowiedz.id"
      v-for="odpowiedz in zawartoscPytania.odpowiedzi"
    >
      <input
        v-model="check"
        :name="zawartoscPytania.id"
        type="radio"
        :value="odpowiedz.id"
      />
      <label>{{ odpowiedz.tresc }}</label>
    </div>
    <p v-if="!answered  ">

    </p>
    <p v-else-if="answered.poprawna == 0">
      Źle
    </p>
    <p v-else-if="answered.poprawna == 1">
      Dobrze
    </p>
    <p v-else>

    </p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      check: " ",
    };
  },
  props: ["zawartoscPytania", 'answered'],
  methods: {
    sprawdzanie: function () {
      this.$emit('answer', this.check != " " ?  this.check : 1)
    },
  },
};
</script>
<style scoped>
</style>