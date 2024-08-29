<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Schedules</h1>
                <Link
                    href="/admin/schedules/create"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                >
                    Create New Schedule
                </Link>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                No
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Type
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Start Date
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                End Date
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="schedule in schedules" :key="schedule.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ schedule.no }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ schedule.type_jp }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ schedule.start_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ schedule.end_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <Link
                                    :href="
                                        '/admin/schedules/' +
                                        schedule.id +
                                        '/edit'
                                    "
                                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                                >
                                    Edit
                                </Link>
                                <Link
                                    :href="'/admin/predictions/' + schedule.no"
                                    class="border border-purple-500 text-purple-700 hover:bg-purple-100 font-bold py-2 px-4 rounded predict-btn"
                                >
                                    Predict
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {
        AdminLayout,
    },
    props: {
        schedules: Array,
    },
};
</script>

<style scoped>
tr {
    height: 50px;
}
.predict-btn {
    margin-left: 8px;
}
</style>
