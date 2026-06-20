import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/function.js'],
            refresh: true,
        }),
    ],
    build: {
        minify: 'esbuild',
        rollupOptions: {
            output: {
                format: 'iife',
            },
        },
    },
    css: {
        url: false,
    },
});
