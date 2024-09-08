import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import "./bootstrap";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/Admin/${name.replace(/^Admin\//, "")}.vue`,
            import.meta.glob("./Pages/Admin/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .mount(el);
    },
});
