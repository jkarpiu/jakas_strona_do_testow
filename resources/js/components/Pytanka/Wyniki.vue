<template>
   <div id="main">
       <h1>Zdane: {{ data.passed }}</h1>
       <h3>Procenty: {{ data.percentage}}</h3>
       <p> Wynik: {{ data.points}} / {{data.max_points}}</p>
    </div> 
</template>
<script lang="ts">
export default {
    props: ['data']
}
</script>