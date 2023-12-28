import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            // entry points
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        exclude: ["js-big-decimal"],
    },
});
