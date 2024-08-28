<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Schedule Details</h1>

            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <p class="mb-4"><strong>No:</strong> {{ schedule.no }}</p>
                <p class="mb-4">
                    <strong>Type:</strong> {{ schedule.type_jp }}
                </p>
                <p class="mb-4">
                    <strong>Start Date:</strong> {{ schedule.start_date }}
                </p>
                <p class="mb-4">
                    <strong>End Date:</strong> {{ schedule.end_date }}
                </p>

                <form @submit.prevent="deleteSchedule">
                    <button
                        type="submit"
                        class="border border-red-500 text-red-700 hover:bg-red-100 font-bold py-2 px-4 rounded"
                    >
                        Delete
                    </button>
                </form>
            </div>

            <!-- Games table -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Games</h2>
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                No
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Home Team
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Away Team
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="game in games" :key="game.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ game.no }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ game.home_team.name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ game.away_team.name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    props: {
        schedule: Object,
        games: Array,
    },
    components: {
        AdminLayout,
    },
    setup(props) {
        const deleteSchedule = () => {
            if (confirm("Are you sure you want to delete this schedule?")) {
                router.delete("/admin/schedules/" + props.schedule.id);
            }
        };

        return { deleteSchedule };
    },
};
</script>

<style scoped></style>
