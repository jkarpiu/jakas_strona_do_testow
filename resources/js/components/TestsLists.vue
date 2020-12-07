<template>
    <div>
        <p :key="test.id" @click="$router.push('/test/' + test.id)" v-for="test in testy">{{ test.name }}</p>
    </div>
</template>
<script>
export default {
    props: ["testy"]
};
</script>
<style scoped></style>
