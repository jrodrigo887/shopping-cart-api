import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    // server: {
    //     hmr: {
    //         host: 'localhost',
    //     },
    // },
    plugins: [
        laravel({
            input: ['resources/ts/app.ts', 'resources/ts/app.ts'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
        // {
        //     name: 'blade',
        //     handleHotUpdate({ file, server }) {
        //         if (file.endsWith('.blade.php')) {
        //             server.ws.send({
        //                 type: 'full-reload',
        //                 path: '*',
        //             });
        //         }
        //     },
        // }

    ],
});
