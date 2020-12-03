<template>
    <div id="classroomsView">
        <div class="toolbox">
            <button class="btn btn-primary" @click="$modal.show('add-classroom')">
                <font-awesome-icon icon="plus" /> Utwórz grupe
            </button>
        </div>
        <div class="classrooms"></div>
        <modal name="add-classroom" styles="background-color: #191919; padding: 25px;" adaptive="true">
            <p>
                Nazwa:
                <input type="text" name="" id="" class="form-control" />
                <button class="btn btn-primary">Dodaj</button>
            </p>
        </modal>
    </div>
</template>
<script lang="ts">
export default {
    methods: {
        createGroup: function async() {}
    },
    data() {
        return {};
    }
};
</script>
<style scoped>
#classroomsView {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: 1fr 1fr;
}
.toolbox {
    display: flex;
    justify-content: flex-end;
}
</style>
