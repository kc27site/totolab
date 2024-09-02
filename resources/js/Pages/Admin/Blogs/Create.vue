<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Create New Blog</h1>

            <form @submit.prevent="createBlog">
                <div class="mb-4">
                    <label
                        for="schedule_no"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Schedule No
                    </label>
                    <select
                        v-model="form.schedule_no"
                        id="type"
                        class="mt-1 block border-gray-300 rounded"
                    >
                        <option
                            v-for="no in schedule_no_list"
                            :key="no"
                            :value="no"
                        >
                            {{ no }}
                        </option>
                    </select>
                    <span
                        v-if="
                            $page.props.errors && $page.props.errors.schedule_no
                        "
                        class="text-red-600"
                    >
                        {{ $page.props.errors.schedule_no }}
                    </span>
                </div>

                <div class="mb-4">
                    <label
                        for="type"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Type
                    </label>
                    <select
                        v-model="form.type"
                        id="type"
                        class="mt-1 block border-gray-300 rounded"
                        required
                    >
                        <option value="1">予想</option>
                        <option value="2">的中</option>
                        <option value="3">振り返り</option>
                        <option value="10">その他</option>
                    </select>
                    <span
                        v-if="$page.props.errors && $page.props.errors.type"
                        class="text-red-600"
                    >
                        {{ $page.props.errors.type }}
                    </span>
                </div>

                <button
                    type="submit"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                >
                    Create Blog
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
    props: {
        schedule_no_list: Object,
    },
    setup() {
        const form = useForm({
            schedule_no: "",
            type: 1,
        });

        const createBlog = () => {
            form.post("/admin/blogs");
        };

        return { form, createBlog };
    },
};
</script>

<style scoped>
select {
    padding: 6px;
    width: 100px;
}
</style>
