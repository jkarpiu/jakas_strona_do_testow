<template>
    <div class="loading"><FacebookLoader color="#0061c9" /></div>
</template>
<script>
import { FacebookLoader } from "vue-spinners-css";
export default {
    components: {
        loading: FacebookLoader
    }
};
</script>
<style scoped>
.loading {
    margin-left: auto;
    margin-right: auto;
    padding-top: 30vh;
    display: flex;
    justify-content: center;
}
</style>
