<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Schedule</h1>
            <div class="mb-4">
                <label
                    for="import-url"
                    class="block text-sm font-medium text-gray-700"
                    >Import Schedule</label
                >
                <input
                    v-model="importUrl"
                    id="import-url"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded"
                />
                <button
                    @click="importSchedule"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded mt-2"
                >
                    Import
                </button>
                <div v-if="errors.import" class="text-red-500 text-sm mt-2">
                    {{ errors.import }}
                </div>
            </div>
            <form @submit.prevent="submit">
                <div
                    v-if="$page.props.errors.error"
                    class="text-red-600 text-sm mb-4"
                >
                    <strong>Error:</strong> {{ $page.props.errors.error }}
                </div>
                <div class="mb-4">
                    <label
                        for="no"
                        class="block text-sm font-medium text-gray-700"
                        >Schedule No</label
                    >
                    <input
                        v-model="form.no"
                        id="no"
                        type="number"
                        class="mt-1 block w-full border-gray-300 rounded"
                        required
                    />
                    <div
                        v-if="$page.props.errors.no"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.no }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="start_date"
                        class="block text-sm font-medium text-gray-700"
                        >Start Date</label
                    >
                    <input
                        v-model="form.start_date"
                        id="start_date"
                        type="date"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                    <div
                        v-if="$page.props.errors.start_date"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.start_date }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="end_date"
                        class="block text-sm font-medium text-gray-700"
                        >End Date (Optional)</label
                    >
                    <input
                        v-model="form.end_date"
                        id="end_date"
                        type="date"
                        class="mt-1 block w-full border-gray-300 rounded"
                    />
                    <div
                        v-if="$page.props.errors.end_date"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.end_date }}
                    </div>
                </div>

                <div
                    v-if="$page.props.errors.at_least_one_required"
                    class="text-red-600 text-sm mt-2"
                >
                    {{ $page.props.errors.at_least_one_required }}
                </div>

                <div class="mb-4">
                    <label
                        for="toto"
                        class="block text-sm font-medium text-gray-700"
                        >Toto</label
                    >
                    <textarea
                        v-model="form.toto"
                        id="toto"
                        rows="13"
                        class="mt-1 block w-full border-gray-300 rounded"
                    ></textarea>
                    <div
                        v-if="$page.props.errors.toto"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.toto }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="mini_toto_a"
                        class="block text-sm font-medium text-gray-700"
                        >Mini Toto A組</label
                    >
                    <textarea
                        v-model="form.mini_toto_a"
                        id="mini_toto_a"
                        rows="5"
                        class="mt-1 block w-full border-gray-300 rounded"
                    ></textarea>
                    <div
                        v-if="$page.props.errors.mini_toto_a"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.mini_toto_a }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="mini_toto_b"
                        class="block text-sm font-medium text-gray-700"
                        >Mini Toto B組</label
                    >
                    <textarea
                        v-model="form.mini_toto_b"
                        id="mini_toto_b"
                        rows="5"
                        class="mt-1 block w-full border-gray-300 rounded"
                    ></textarea>
                    <div
                        v-if="$page.props.errors.mini_toto_b"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.mini_toto_b }}
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="toto_goal3"
                        class="block text-sm font-medium text-gray-700"
                        >Toto GOAL3</label
                    >
                    <textarea
                        v-model="form.toto_goal3"
                        id="toto_goal3"
                        rows="3"
                        class="mt-1 block w-full border-gray-300 rounded"
                    ></textarea>
                    <div
                        v-if="$page.props.errors.toto_goal3"
                        class="text-red-600 text-sm mt-2"
                    >
                        {{ $page.props.errors.toto_goal3 }}
                    </div>
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
import axios from "axios";
import { ref } from "vue";
export default {
    components: {
        AdminLayout,
    },
    setup(props) {
        const getTodayDate = () => {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, "0");
            const day = String(today.getDate()).padStart(2, "0");
            return `${year}-${month}-${day}`;
        };
        const form = useForm({
            no: "",
            start_date: getTodayDate(),
            end_date: "",
            toto: "",
            mini_toto_a: "",
            mini_toto_b: "",
            toto_goal3: "",
        });
        const importUrl = ref("");
        const errors = ref({});

        const submit = () => {
            form.post("/admin/schedules/");
        };
        const importSchedule = async () => {
            try {
                const response = await axios.post("/admin/schedules/import", {
                    url: importUrl.value,
                });
                form.no = response.data.schedule_no;
                form.start_date = response.data.start_date;
                form.toto = response.data.toto;
                form.mini_toto_a = response.data.mini_toto_a;
                form.mini_toto_b = response.data.mini_toto_b;
                form.toto_goal3 = response.data.toto_goal3;
            } catch (error) {
                errors.value.import =
                    error.response.data.message || "Failed to import schedule.";
            }
        };

        return { form, submit, importUrl, errors, importSchedule };
    },
};
</script>

<style scoped></style>
