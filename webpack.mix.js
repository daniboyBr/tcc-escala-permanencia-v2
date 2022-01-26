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
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/material-dashboard/material-dashboard.min.css', 'public/css')
    .css('node_modules/bootstrap/dist/css/bootstrap.min.css', 'css/bootstrap.css')
    .css('node_modules/bootstrap-select/dist/css/bootstrap-select.min.css', 'css/bootstrap-selectpicker.css')
    .js('resources/js/material-dashboard/material-dashboard.min.js', 'public/js')
    .js('resources/js/material-dashboard/plugins/perfect-scrollbar.jquery.min.js', 'js/perfect-scrollbar.js')
    .js('resources/js/material-dashboard/core/bootstrap-material-design.min.js', 'js/dashboard.js')
    .js('node_modules/bootstrap-select/dist/js/bootstrap-select.min.js', 'js/bootstrap-selectpicker.js')
    .sourceMaps();
