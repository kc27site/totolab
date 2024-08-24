<template>
    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Admin Settings</h2>

            <!-- ログアウトボタン -->
            <form @submit.prevent="logout">
                <button
                    type="submit"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded border border-gray-400"
                >
                    Logout
                </button>
            </form>
        </div>

        <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
            {{ $page.props.flash }}
            {{ $page.props.errors }}
            <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                {{ $page.props.flash.success }}
            </div>
            <form @submit.prevent="updateSetting">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                    <span
                        v-if="$page.props.errors && $page.props.errors.name"
                        class="text-red-600"
                        >{{ $page.props.errors.name }}</span
                    >
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                    <span
                        v-if="$page.props.errors && $page.props.errors.email"
                        class="text-red-600"
                        >{{ $page.props.errors.email }}</span
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700"
                        >Password (Optional)</label
                    >
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                    <span
                        v-if="$page.props.errors && $page.props.errors.password"
                        class="text-red-600"
                        >{{ $page.props.errors.password }}</span
                    >
                </div>

                <div class="mb-4">
                    <label
                        for="password_confirmation"
                        class="block text-gray-700"
                        >Confirm Password</label
                    >
                    <input
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script>
import { useForm, usePage, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    components: {
        AdminLayout,
    },
    setup() {
        const { props } = usePage();
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const form = useForm({
            name: props.admin.name,
            email: props.admin.email,
            password: "",
            password_confirmation: "",
        });

        const updateSetting = () => {
            form.post("/admin/setting");
        };

        const logout = () => {
            router.post("/admin/logout");
        };

        return { form, updateSetting, logout };
    },
};
</script>
