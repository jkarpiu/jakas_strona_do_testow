<template>
   <div id="results">
       <!-- <h1 class="center">Zdane: {{ data.passed }}</h1> -->
       <h2 class="center">Uzyskano wynik: <span class="result">{{ data.percentage}}% ({{ data.points}}/{{data.max_points}})</span></h2>
    </div> 
</template>
<script lang="ts">
export default {
    props: ['data']
}
</script>
<style scoped>
    #results   {
        margin-top: 2rem;
    }
    .center{
        text-align: center;
    }
    .result {
        color: #0061C9;
    }
</style>