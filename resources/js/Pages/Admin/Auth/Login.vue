<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="panel bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">Login</h2>

            <div v-if="$page.props.errors.email" class="text-red-600 mb-4">
                {{ $page.props.errors.email }}
            </div>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        class="mt-1 block w-full border-gray-300 rounded"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700"
                        >Password</label
                    >
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        class="mt-1 block w-full border-gray-300 rounded"
                        required
                    />
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { useForm, usePage } from "@inertiajs/vue3";

export default {
    setup() {
        const { props } = usePage();
        const form = useForm({
            email: "",
            password: "",
        });
        const submit = () => {
            form.post("/admin/login");
        };

        return { form, submit };
    },
};
</script>

<style scoped>
.panel {
    width: 450px;
}
</style>
