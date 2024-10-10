import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { format, addDays } from "date-fns";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/Front/${name.replace(/^Front\//, "")}.vue`,
            import.meta.glob("./Pages/Front/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.config.globalProperties.$dateFns = {
            format,
            addDays,
        };
        app.use(plugin).component("Link", Link).mount(el);
    },
});
