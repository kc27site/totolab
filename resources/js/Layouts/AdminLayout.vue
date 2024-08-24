<template>
    <div class="flex">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main content -->
        <div class="flex-grow p-6 bg-gray-100">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import Sidebar from "@/Components/Sidebar.vue";

export default {
    components: {
        Sidebar,
    },
};
</script>
