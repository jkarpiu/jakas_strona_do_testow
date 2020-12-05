<template>
    <div id="classroomView">
        <div class="toolbox">
            <button class="btn btn-primary">
                <font-awesome-icon icon="link" />
            </button>
        </div>
        <div class="mainVie"></div>
    </div>
</template>
<style scoped>
#classroomView {
    display: grid;
    grid-template-rows: 1fr 1fr;
    grid-template-columns: 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}
</style>
