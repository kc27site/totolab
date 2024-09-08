import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            // input: ["resources/js/app.js", "resources/css/app.css"],
            input: {
                // フロントエンド用
                app: "resources/js/app.js",
                // 管理画面用
                admin: "resources/js/admin.js",
            },
            refresh: true,
        }),
        vue(),
    ],
});
