<template>
    <div id="groupList">
        <div  :key="group.id" v-for="group in list" @click="$router.push('/groups/id/'+group.id)">
            Nazwa: {{ group.name }}
            Ilość osób: 12
        </div>
    </div>
</template>
<script lang="ts">
export default {
    props: ['list']
};
</script>
<style scoped>
#groupList {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap: 24px;
    padding: 24px;
}

#groupList > div {
    background: #0061c9 ;
    padding: 5px;
    cursor: pointer;
}

#groupList > div:hover {
    background: #01438a ;
}
</style>
