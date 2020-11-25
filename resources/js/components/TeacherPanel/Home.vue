<template>
  <div id="main">
      <div class="classes">
          <h1>Klasy:</h1>
      </div>
      <div class="tests">
          <h1>Testy:</h1>
      </div>
  </div>
</template>
<script lang="ts">
export default {};
</script>
<style scoped>
#main {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-around;
  align-items: baseline;
  align-content: stretch;
}
</style>
