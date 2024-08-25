<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Team</h1>

            <form @submit.prevent="updateTeam">
                <div class="mb-4">
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                        >Category</label
                    >
                    <select
                        v-model="form.category"
                        id="category"
                        class="mt-1 block w-full border-gray-300 rounded"
                    >
                        <option value="1">J1</option>
                        <option value="2">J2</option>
                        <option value="3">J3</option>
                        <option value="4">その他</option>
                    </select>
                    <span
                        v-if="$page.props.errors && $page.props.errors.category"
                        class="text-red-600"
                        >{{ $page.props.errors.category }}
                    </span>
                </div>

                <div class="mb-4">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                    >
                    <input
                        v-model="form.name"
                        id="name"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded"
                        required
                    />
                    <span
                        v-if="$page.props.errors && $page.props.errors.name"
                        class="text-red-600"
                        >{{ $page.props.errors.name }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <button
                        type="submit"
                        class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                    >
                        Save
                    </button>
                    <button
                        @click.prevent="deleteTeam"
                        class="border border-red-500 text-red-700 hover:bg-red-100 font-bold py-2 px-4 rounded"
                    >
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {
        AdminLayout,
    },
    props: {
        team: Object,
    },
    setup(props) {
        const form = useForm({
            category: props.team.category,
            name: props.team.name,
        });

        const updateTeam = () => {
            form.put("/admin/teams/" + props.team.id);
        };

        const deleteTeam = () => {
            if (confirm("Are you sure you want to delete this team?")) {
                router.delete("/admin/teams/" + props.team.id);
            }
        };

        return { form, updateTeam, deleteTeam };
    },
};
</script>

<style scoped></style>
