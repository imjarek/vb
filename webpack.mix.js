const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
// .js('resources/assets/js/app.js', 'public/js')

    .sass('resources/assets/sass/bootstrap.scss', 'public/css/bootstrap.css')
    .js('resources/assets/js/bootstrap.js', 'public/js')

    .sass('resources/assets/sass/layout/style.scss', 'public/css/layout.css')
    .copy('resources/assets/js/layout.js', 'public/js')

    .copy('resources/assets/js/commands.js', 'public/js/commands.js')
    .copy('resources/assets/js/profile.js', 'public/js/profile.js')
    .copy('resources/assets/js/users.js', 'public/js/users.js')
    .copy('resources/assets/js/vk-bots.js', 'public/js/vk-bots.js')
    .copy('resources/assets/js/vk-bots-trash.js', 'public/js/vk-bots-trash.js')

    .copyDirectory('resources/assets/libs', 'public/libs')
    .copyDirectory('resources/assets/img', 'public/img');
