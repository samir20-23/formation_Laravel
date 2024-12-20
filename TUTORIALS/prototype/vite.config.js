import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import legacy from '@vitejs/plugin-legacy';  // Make sure the legacy plugin is imported

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        legacy({
            targets: ['defaults', 'not IE 11'],  // Adjust if necessary
        }),
    ],
    server: {
        open: true,  // Opens the browser automatically
    },
});
