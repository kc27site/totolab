<template>
    <FrontLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ul class="mt-6 space-y-4">
                <li
                    v-for="blog in blogs"
                    :key="blog.id"
                    class="p-4 bg-white rounded shadow"
                >
                    {{ blog }}
                </li>
            </ul>
        </div>
    </FrontLayout>
</template>

<script>
import FrontLayout from "@/Layouts/FrontLayout.vue";
export default {
    components: {
        FrontLayout,
    },
    props: {
        blogs: Object,
    },
};
</script>

<style scoped></style>
