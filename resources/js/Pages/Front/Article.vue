<template>
    <FrontLayout>
        <div class="content">
            <div class="main-content">
                <article>
                    <h2>{{ blog.title }}</h2>
                    <p>{{ $dateFns.format(blog.released_at, "yyyy.MM.dd") }}</p>
                </article>
            </div>
            <Sidebar :blogs="past_blogs" />
        </div>
    </FrontLayout>
</template>

<script>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import Sidebar from "@/Components/Front/Sidebar.vue";

export default {
    components: {
        FrontLayout,
        Sidebar,
    },
    props: {
        blog: Object,
        past_blogs: Object,
    },
};
</script>

<style scoped>
.content {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 20px;
    max-width: 1200px;
    margin: auto;
    width: 100%;
    box-sizing: border-box;
}

.main-content {
    flex: 5;
    margin-right: 20px;
}

article {
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

h2 {
    font-size: 18px;
    font-weight: bold;
}

p {
    color: #555555;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table,
th,
td {
    border: 1px solid #dddddd;
    text-align: center;
}

th,
td {
    padding: 10px;
}

th {
    background-color: #e6e6fa;
}

td.predicted {
    background-color: #c3c3ce;
    color: #ffffff;
}

table th:nth-child(2),
table th:nth-child(3),
table th:nth-child(4),
table td:nth-child(2),
table td:nth-child(3),
table td:nth-child(4) {
    width: 15%;
}

@media (max-width: 768px) {
    .content {
        flex-direction: column;
    }

    .main-content {
        margin-right: 0;
    }

    table {
        font-size: 14px;
    }
}
</style>
