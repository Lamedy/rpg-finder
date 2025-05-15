import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        tailwindcss(),
    ],
    server: {
        host: 'localhost', // или '127.0.0.1'
        strictPort: true,
        port: 5173,        // порт по умолчанию
    },
});
