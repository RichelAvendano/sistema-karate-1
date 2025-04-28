import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //css
                'resources/css/app.css',
                'resources/css/role.css',
                'resources/css/bootstrap.css',
                'resources/css/modal.css',
                'resources/css/card-dojos.css',
                'resources/css/file-input.css',
                'resources/css/panel-glass.css',
                'resources/css/form.css',
                'resources/css/table.css',
                'resources/css/select.css',
                //js 
                'resources/js/app.js',
                'resources/js/alpine.js',
                
            ],
            refresh: true,
        }),
    ],
});
