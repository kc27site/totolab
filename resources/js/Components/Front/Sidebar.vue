<template>
    <aside class="sidebar">
        <h3>過去の記事</h3>
        <Link
            v-for="blog in blogs"
            :key="blog.id"
            :href="`/article/${blog.no}`"
            >{{ blog.title }}</Link
        >
    </aside>
</template>

<script>
export default {
    props: {
        blogs: Object,
    },
};
</script>

<style scoped>
.sidebar {
    flex: 1;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar h3 {
    color: #663399;
    margin-top: 0;
    font-weight: bold;
    margin-bottom: 16px;
}

.sidebar a {
    display: block;
    color: #663399;
    text-decoration: none;
    margin-bottom: 8px;
    font-weight: bold;
}
</style>
