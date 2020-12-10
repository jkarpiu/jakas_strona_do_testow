<template>
    <div>
        <div>
            <p
                :key="test.id"
                @click="$router.push('/test/' + test.id)"
                v-for="test in testy"
            ></p>
        </div>
        <div class="wyniki_table">
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Dzial</th>
                        <th>Termin</th>
                        <th>Klasa</th>
                    </tr>
                </thead>
                <tr
                    :key="test.id"
                    v-for="test in testy"
                    @click="$router.push('/test/' + test.id)"
                >
                    <th>{{ test.name }}</th>
                    <th>{{ test.dzial.nazwa }}</th>
                    <th>{{ test.start }}</th>
                    <th>{{ test.group.name }}</th>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ["testy"]
};
</script>
<style scoped></style>
