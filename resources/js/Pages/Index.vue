<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Soccer Teams</h1>
        <ul class="mt-6 space-y-4">
            <li
                v-for="team in teams"
                :key="team"
                class="p-4 bg-white rounded shadow"
            >
                {{ team }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        teams: Array,
    },
};
</script>

<style scoped></style>
