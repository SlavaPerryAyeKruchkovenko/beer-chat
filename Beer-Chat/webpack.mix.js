const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/authentication.js', 'public/js')
    .sass('resources/sass/app.sass', 'public/css')
    .sass('resources/sass/main.sass', 'public/css')
    .sass('resources/sass/messenger.sass', 'public/css')
    .postCss('resources/sass/authentication.css', 'public/css')
    .postCss('resources/css/reset200802.css', 'public/css');
