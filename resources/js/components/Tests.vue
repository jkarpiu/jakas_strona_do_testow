<template>
    <div id="testsView">
        <div class="toolbox">
            <button
                class="btn btn-primary"
                @click="$modal.show('add-test')"
                v-if="$store.state.user != null && $store.state.user.role == 2"
            >
                <font-awesome-icon icon="plus" /> Utwórz Test
            </button>
        </div>
        <div class="mainView">

        </div>
        <modal
            name="add-test"
            styles="background-color: #191919; padding: 25px;"
            adaptive
        >
            <p>
                <input
                    type="text"
                    v-model="new_test_name"
                    placeholder="Nazwij swój test"
                    name=""
                    id=""
                    class="form-control"
                />
                <datetime v-model="new_test_date"></datetime>
                <button @click="createGroup" class="btn btn-primary">
                    Dodaj test
                </button>
            </p>
        </modal>
    </div>
</template>
<script>
export default {
    data() {
        return {
            new_test_name: "",
            new_test_date: null
        };
    }
};
</script>
