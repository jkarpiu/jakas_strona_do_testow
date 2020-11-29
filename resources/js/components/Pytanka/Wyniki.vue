<template>
   <div id="main">
       <h1 class="center">Zdane: {{ data.passed }}</h1>
       <h3 class="center">Procenty: {{ data.percentage}}</h3>
       <p  class="center"> Wynik: {{ data.points}} / {{data.max_points}}</p>
    </div> 
</template>
<script lang="ts">
export default {
    props: ['data']
}
</script>
<style scoped>
    #main   {
        margin-top: 2rem;
    }
    .center{
        text-align: center;
    }
</style>