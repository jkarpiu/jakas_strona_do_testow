<template>
    <div id="groupList">
        <div  :key="group.id" v-for="group in list" @click="$router.push('/groups/id/'+group.id)">
            <div style="height: 4rem; ">             
                    <p class="name">{{ group.name }}</p>
                    <p class="author">autor classroomu</p>    
            </div> 
            <div class=group-down>
                
            </div>
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
    margin-left: auto;
    margin-right: auto;
    max-width: 80%;
    padding: 24px;
}

#groupList > div {
    background: rgb(33, 118, 187) ;
    border-radius: 8px;
    border: 1px none;
    cursor: pointer;
}

#groupList > div:hover {
    background: #01438a ;
}

.group-down {
    height: 8rem; 
    background-color: rgb(231, 231, 231);
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px; 
    border-bottom: 1px none;
}
.name  {
    padding-top: 0.7rem;
    padding-left: 1.7rem;
    font-size: 1.7rem;
}

.author {
    color: rgb(231, 231, 231);
}
</style>
