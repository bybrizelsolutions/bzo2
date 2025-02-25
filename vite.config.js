import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/assets/js/vite.js',
                'resources/assets/css/sb-admin-2.min.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@assets': '/resources/assets'
        }
    }
});
