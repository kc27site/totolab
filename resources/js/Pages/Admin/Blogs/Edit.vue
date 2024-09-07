<template>
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Blog</h1>
            <div v-if="$page.props.flash.success" class="mb-4 text-green-600">
                {{ $page.props.flash.success }}
            </div>
            <div v-if="$page.props.flash.error" class="mb-4 text-red-600">
                {{ $page.props.flash.error }}
            </div>
            <form @submit.prevent="updateBlog">
                <div class="mb-4">
                    <label
                        for="schedule_no"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Schedule No
                    </label>
                    <div>{{ blog.schedule_no }}</div>
                </div>

                <div class="mb-4">
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Title
                    </label>
                    <input
                        v-model="form.title"
                        id="title"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded"
                        required
                    />
                    <span
                        v-if="$page.props.errors && $page.props.errors.title"
                        class="text-red-600"
                    >
                        {{ $page.props.errors.title }}
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

                <div class="mb-4">
                    <label
                        for="status"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Status
                    </label>
                    <select
                        v-model="form.status"
                        id="status"
                        class="mt-1 block border-gray-300 rounded"
                        required
                    >
                        <option v-if="initialStatus === 1" value="1">
                            下書き
                        </option>
                        <option value="2">公開</option>
                        <option value="3">非公開</option>
                    </select>
                    <span
                        v-if="$page.props.errors && $page.props.errors.status"
                        class="text-red-600"
                    >
                        {{ $page.props.errors.status }}
                    </span>
                </div>
                <div class="mb-4" v-if="blog.released_at">
                    <label
                        for="status"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Released_at
                    </label>
                    <div>{{ blog.released_at }}</div>
                </div>

                <button
                    type="submit"
                    class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-2 px-4 rounded"
                >
                    Update Blog
                </button>
            </form>

            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-4">Edit Sections</h2>
                <VueDraggable v-model="sections">
                    <div
                        v-for="(section, index) in sections"
                        :key="index"
                        class="relative item-box"
                    >
                        <div v-if="section.type === 1" class="mb-2">
                            <input
                                v-model="section.content"
                                type="text"
                                class="block w-full border-gray-300 rounded"
                                placeholder="Enter heading"
                            />
                        </div>
                        <div v-else-if="section.type === 2" class="mb-2">
                            <textarea
                                v-model="section.content"
                                rows="4"
                                class="block w-full border-gray-300 rounded"
                                placeholder="Enter text content"
                            ></textarea>
                        </div>
                        <div v-else-if="section.type === 3" class="mb-2">
                            <select
                                v-model="section.game_id"
                                class="block border-gray-300 rounded"
                            >
                                <optgroup
                                    v-for="schedule in schedules"
                                    :key="schedule.id"
                                    :label="scheduleTypes[schedule.type]"
                                >
                                    <option
                                        v-for="game in schedule.games"
                                        :key="game.id"
                                        :value="game.id"
                                    >
                                        {{ teams[game.home_team_id] }} ×
                                        {{ teams[game.away_team_id] }}
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div v-else-if="section.type === 4" class="mb-2">
                            <select
                                v-model="section.schedule_id"
                                class="block border-gray-300 rounded"
                            >
                                <option
                                    v-for="schedule in schedules"
                                    :value="schedule.id"
                                    :key="schedule.id"
                                >
                                    {{
                                        schedule.no +
                                        "回 " +
                                        scheduleTypes[schedule.type]
                                    }}
                                </option>
                            </select>
                        </div>
                        <button
                            @click="removeSection(index)"
                            class="absolute right-0 top-0 text-red-600 remove-btn"
                        >
                            ×
                        </button>
                    </div>
                </VueDraggable>

                <div class="flex items-center add-items">
                    <button
                        @click="addSection(1)"
                        class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-1 px-1 rounded"
                    >
                        H2
                    </button>
                    <button
                        @click="addSection(2)"
                        class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-1 px-1 rounded"
                    >
                        Text
                    </button>
                    <button
                        @click="addSection(3)"
                        class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-1 px-1 rounded"
                    >
                        Game
                    </button>
                    <button
                        @click="addSection(4)"
                        class="border border-gray-500 text-gray-700 hover:bg-gray-100 font-bold py-1 px-1 rounded"
                    >
                        Schedule
                    </button>
                </div>

                <div class="mt-6">
                    <button
                        @click="saveSections"
                        class="border border-blue-500 text-blue-700 hover:bg-blue-100 font-bold py-2 px-4 rounded"
                    >
                        Save Sections
                    </button>
                </div>
            </div>
            <ul v-for="schedule in schedules" :key="schedule.id" class="mt-6">
                {{
                    scheduleTypes[schedule.type]
                }}
                <li v-for="game in schedule.games" :key="game.id">
                    {{ teams[game.home_team_id] }} ×
                    {{ teams[game.away_team_id] }}
                </li>
            </ul>
        </div>
    </AdminLayout>
</template>

<script>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { VueDraggable } from "vue-draggable-plus";

export default {
    components: {
        AdminLayout,
        VueDraggable,
    },
    props: {
        blog: Object,
        initialSections: Object,
        schedules: Object,
        teams: Object,
        scheduleTypes: Object,
    },
    setup(props) {
        const form = useForm({
            title: props.blog.title || "",
            type: props.blog.type,
            status: props.blog.status,
        });

        const initialStatus = props.blog.status;

        const sections = ref(
            props.initialSections.map((section) => ({
                id: section.id || null,
                type: section.type,
                content: section.content || "",
                game_id: section.game_id || null,
                schedule_id: section.schedule_id || null,
                position: section.position,
            }))
        );

        const addSection = (type) => {
            sections.value.push({
                id: null,
                type,
                content: "",
                game_id: null,
                schedule_id: null,
                position: sections.value.length + 1,
            });
        };

        const removeSection = (index) => {
            if (confirm("Are you sure you want to delete this section?")) {
                sections.value.splice(index, 1);
                sections.value.forEach((section, idx) => {
                    section.position = idx + 1;
                });
            }
        };

        const saveSections = async () => {
            const filteredSections = sections.value.filter(
                (section) =>
                    section.content.trim() !== "" ||
                    section.game_id ||
                    section.schedule_id
            );

            const data = filteredSections.map((section, index) => ({
                id: section.id,
                type: section.type,
                content: section.content,
                game_id: section.game_id,
                schedule_id: section.schedule_id,
                position: index + 1,
            }));
            console.log(data);
            try {
                await axios.post(`/admin/blogs/${props.blog.id}/sections`, {
                    sections: data,
                });
                router.visit(`/admin/blogs/${props.blog.id}/edit`, {
                    preserveScroll: true,
                    onSuccess: () => {
                        router.visit(`/admin/blogs/${props.blog.id}/edit`, {
                            preserveScroll: true,
                            replace: true,
                        });
                    },
                });
            } catch (error) {
                console.error("Error saving sections:", error);
            }
        };

        const updateBlog = () => {
            form.put(`/admin/blogs/${props.blog.id}`);
        };

        const deleteBlog = () => {
            if (confirm("Are you sure you want to delete this blog?")) {
                router.delete(`/admin/blogs/${props.blog.id}`);
            }
        };

        return {
            form,
            updateBlog,
            deleteBlog,
            initialStatus,
            sections,
            addSection,
            removeSection,
            saveSections,
        };
    },
};
</script>

<style scoped>
textarea {
    resize: vertical;
}
button {
    transition: all 0.3s ease;
}
.item-box {
    padding-bottom: 18px;
}
.add-items button {
    font-size: 12px;
    margin-right: 4px;
}
.remove-btn {
    position: absolute;
    right: -18px;
    top: 0;
    font-size: 14px;
    padding: 2px;
    color: gray;
}
</style>
