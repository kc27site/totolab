<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Team</h1>

            <form @submit.prevent="createTeam">
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

                <button
                    type="submit"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                >
                    Create
                </button>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {
        AdminLayout,
    },
    setup() {
        const form = useForm({
            category: 1,
            name: "",
        });

        const createTeam = () => {
            form.post("/admin/teams");
        };

        return { form, createTeam };
    },
};
</script>

<style scoped></style>
