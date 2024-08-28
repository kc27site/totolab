<template>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white">
            <div class="p-6 text-2xl font-bold text-center">totolab</div>
            <nav class="mt-10 space-y-4">
                <Link
                    href="/admin/teams"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                    :class="{
                        'bg-gray-700': $page.url.startsWith('/admin/teams'),
                    }"
                >
                    Teams
                </Link>
                <Link
                    href="/admin/schedules"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                    :class="{
                        'bg-gray-700': $page.url.startsWith('/admin/schedules'),
                    }"
                >
                    Schedules
                </Link>
                <Link
                    href="/admin/setting"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                    :class="{
                        'bg-gray-700': $page.url.startsWith('/admin/setting'),
                    }"
                >
                    Admin
                </Link>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-grow p-6">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {},
};
</script>
