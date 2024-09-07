<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Teams</h1>
            <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                {{ $page.props.flash.success }}
            </div>
            <div
                v-for="(teams, category) in groupedTeams"
                :key="category"
                class="mb-6"
            >
                <h2 class="text-xl font-semibold mb-4">{{ category }}</h2>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full table-auto">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="team in teams" :key="team.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ team.name }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right"
                                >
                                    <button
                                        @click="editTeam(team.id)"
                                        class="border border-gray-600 text-gray-600 hover:bg-gray-100 font-bold py-2 px-4 rounded transition duration-300 ease-in-out"
                                    >
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <Link
                href="/admin/teams/create"
                class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
            >
                Create
            </Link>
        </div>
    </AdminLayout>
</template>

<script>
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {
        AdminLayout,
    },
    props: {
        groupedTeams: Object,
    },
    methods: {
        editTeam(teamId) {
            router.visit(`/admin/teams/${teamId}/edit`);
        },
    },
};
</script>

<style scoped>
button {
    color: #718096;
}
</style>
