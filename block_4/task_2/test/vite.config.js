import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

/**

// For Vue 

 import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
export default defineConfig({
plugins: [
laravel(['resources/js/app.js']),
vue({
Конфигурация Laravel Vite 195
template: {
transformAssetUrls: {
base: null,
includeAbsolute: false,
},
},
}),
],
});
 */
