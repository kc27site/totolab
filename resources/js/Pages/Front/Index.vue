<template>
    <FrontLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ul class="mt-6 space-y-4">
                <li
                    v-for="blog in blogs"
                    :key="blog.id"
                    class="p-4 bg-white rounded shadow"
                    @click="goToArticle(blog.no)"
                >
                    <div class="title">{{ blog.title }}</div>
                    <span class="released_at">{{
                        $dateFns.format(blog.released_at, "yyyy.MM.dd")
                    }}</span>
                </li>
            </ul>
        </div>
    </FrontLayout>
</template>

<script>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import { router } from "@inertiajs/vue3";

export default {
    components: {
        FrontLayout,
    },
    props: {
        blogs: Object,
    },
    methods: {
        goToArticle(blog_no) {
            router.visit(`/article/${blog_no}`);
        },
    },
};
</script>

<style scoped>
li {
    cursor: pointer;
}
.title {
    font-size: 17px;
    font-weight: bold;
}
.released_at {
    font-size: 13px;
    color: gray;
}
</style>
