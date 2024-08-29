<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">
                Predictions for Schedule No {{ scheduleNo }}
            </h1>

            <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                {{ $page.props.flash.success }}
            </div>
            <div v-if="$page.props.flash.error" class="mb-4 text-red-600">
                {{ $page.props.flash.error }}
            </div>
            <div v-if="successMsg" class="mb-4 text-green-600">
                {{ successMsg }}
            </div>
            <div v-if="errorMsg" class="mb-4 text-red-600">
                {{ errorMsg }}
            </div>
            <!-- Tabs -->
            <div class="mb-4 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button
                        v-for="(schedule, index) in schedules"
                        :key="schedule.id"
                        @click="activeTab = index"
                        :class="[
                            'py-4 px-1 text-center border-b-2 font-medium text-sm',
                            activeTab === index
                                ? 'border-indigo-500 text-indigo-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                        ]"
                    >
                        {{ schedule.type_jp }}
                    </button>
                </nav>
            </div>

            <!-- Prediction Table -->
            <form @submit.prevent="submitPredictions">
                <div
                    v-for="(schedule, index) in schedules"
                    :key="schedule.id"
                    v-show="activeTab === index"
                >
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Home Team
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Win
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Draw
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Lose
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Away Team
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="game in schedule.games" :key="game.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ teams[game.home_team_id] }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <input
                                        type="checkbox"
                                        v-model="
                                            predictions[schedule.id][game.id]
                                                .result_1
                                        "
                                    />
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <input
                                        type="checkbox"
                                        v-model="
                                            predictions[schedule.id][game.id]
                                                .result_0
                                        "
                                    />
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <input
                                        type="checkbox"
                                        v-model="
                                            predictions[schedule.id][game.id]
                                                .result_2
                                        "
                                    />
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right"
                                >
                                    {{ teams[game.away_team_id] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button
                        type="submit"
                        class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Save Predictions for {{ schedule.type_jp }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import { ref } from "vue";
// import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
export default {
    components: {
        AdminLayout,
    },
    props: {
        schedules: Array,
        teams: Object,
    },
    setup(props) {
        const activeTab = ref(0);
        const predictions = ref({});
        const scheduleNo = ref(
            props.schedules.length > 0 ? props.schedules[0].no : ""
        );
        let successMsg = null;
        let errorMsg = null;
        props.schedules.forEach((schedule) => {
            predictions.value[schedule.id] = {};
            schedule.games.forEach((game) => {
                predictions.value[schedule.id][game.id] = {
                    result_0: Boolean(game.prediction?.result_0),
                    result_1: Boolean(game.prediction?.result_1),
                    result_2: Boolean(game.prediction?.result_2),
                };
            });
        });

        // const submitPredictions = () => {
        //     const scheduleId = props.schedules[activeTab.value].id;
        //     const data = [];

        //     for (const gameId in predictions.value[scheduleId]) {
        //         data.push({
        //             schedule_id: scheduleId,
        //             game_id: gameId,
        //             ...predictions.value[scheduleId][gameId],
        //         });
        //     }

        //     useForm().post("/admin/predictions", data);
        // };
        const submitPredictions = async () => {
            try {
                const token = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");
                const scheduleId = props.schedules[activeTab.value].id;
                const data = [];

                for (const gameId in predictions.value[scheduleId]) {
                    data.push({
                        schedule_id: scheduleId,
                        game_id: gameId,
                        result_0: predictions.value[scheduleId][gameId].result_0
                            ? 1
                            : 0,
                        result_1: predictions.value[scheduleId][gameId].result_1
                            ? 1
                            : 0,
                        result_2: predictions.value[scheduleId][gameId].result_2
                            ? 1
                            : 0,
                    });
                }

                await axios.post("/admin/predictions", data, {
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                });
                console.log("Predictions saved successfully");
                successMsg = "Predictions saved successfully";
            } catch (error) {
                errorMsg = "Predictions error";
                console.error("Error saving predictions:", error);
                if (error.response && error.response.data) {
                    console.error("Server response:", error.response.data);
                }
            }
        };

        return {
            activeTab,
            scheduleNo,
            predictions,
            successMsg,
            errorMsg,
            submitPredictions,
        };
    },
};
</script>

<style scoped>
input[type="checkbox"] {
    width: 20px;
    height: 20px;
}
</style>
