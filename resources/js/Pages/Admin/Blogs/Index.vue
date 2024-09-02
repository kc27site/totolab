<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Blogs</h1>
                <Link
                    href="/admin/blogs/create"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                >
                    Create Blog
                </Link>
            </div>
            <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                {{ $page.props.flash.success }}
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="blog in blogs" :key="blog.id">
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ blog.no }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ blog.schedule_no }}
                            </td>
                            <td class="px-4 py-4">
                                {{ blog.title }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ blog.type_jp }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span
                                    :class="statusClass(blog.status)"
                                    class="px-2 py-1 text-sm font-medium rounded border status-icon"
                                >
                                    {{ blog.status_jp }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                {{ blog.released_at }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <button
                                    @click="editBlog(blog.id)"
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
        blogs: Array,
    },
    methods: {
        editBlog(blogId) {
            router.visit(`/admin/blogs/${blogId}/edit`);
        },
        statusClass(status) {
            switch (status) {
                case 1:
                    return "border-gray-400 text-gray-500";
                case 2:
                    return "released";
                case 3:
                    return "closed";
                default:
                    return "border-gray-300 text-gray-500 bg-gray-100";
            }
        },
    },
};
</script>

<style scoped>
button {
    color: #718096;
}
.status-icon {
    padding: 2px 4px;
}
.status-icon.released {
    color: #2c87d7;
    border-color: #2c87d7;
}
.status-icon.closed {
    color: #e65656;
    border-color: #e65656;
}
</style>
