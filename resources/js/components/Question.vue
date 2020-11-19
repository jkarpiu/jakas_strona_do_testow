<template>
  <div>
    <p>{{ zawartoscPytania.tresc }}</p>
    <div
      v-bind:key="odpowiedz.id"
      v-for="odpowiedz in zawartoscPytania.odpowiedzi"
    >
      <input name="odpowiedz" type="radio" :value="odpowiedz.id" />
      <label>{{ odpowiedz.tresc }}</label>
    </div>
  </div>
</template>
<script>
export default {
  props: ["zawartoscPytania"],
};
</script>
<style scoped>
</style>