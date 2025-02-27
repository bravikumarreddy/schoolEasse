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

let mix = require('laravel-mix');

mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import',"@babel/plugin-proposal-class-properties"],



});
mix.webpackConfig(webpack => {
    return {
        output: {
            publicPath: '/',
            chunkFilename: 'js/[name].js',
        },
    };
});
const fs = require('fs');



mix.scripts([
    'resources/assets/theme/application/js/initializer.js',
], 'public/js/application.js')

mix.styles([
    'resources/assets/theme/application/css/app-layout.css',
], 'public/css/application.css')

mix.styles([
    'resources/assets/theme/application/css/loader.css',
], 'public/css/loader.css')





mix.react('resources/assets/js/fee_groups.js', 'public/js')
mix.react('resources/assets/js/daily-attendance.js', 'public/js')


mix.js('resources/assets/js/chart.js', 'public/js');
 mix.js('resources/assets/js/multiple.js', 'public/js');

mix.js('resources/assets/js/bootstrap4.js', 'public/js');



mix.scripts([
    //'resources/assets/theme/vendors/js/jquery-2.1.3.min.js',
    //'resources/assets/theme/vendors/js/bootstrap-3.3.7.min.js',
    //'resources/assets/theme/vendors/js/bootstrap-4.bundle.min.js',
    //'resources/assets/theme/vendors/js/dataTables-1.10.16.min.js',
    //'resources/assets/theme/vendors/js/dataTables-1.10.16.bootstrap.min.js',
    //'resources/assets/theme/vendors/js/chosen.jquery.min.js',
    'resources/assets/theme/vendors/js/bootstrap-datepicker3.min.js',
], 'public/js/vendors.js')

mix.styles([
    // 'resources/assets/theme/vendors/css/bootstrap.min.css',
    //'resources/assets/theme/vendors/css/bootstrap-4.min.css',
    //'resources/assets/theme/vendors/css/dataTables-1.10.16.bootstrap.min.css',
    'resources/assets/theme/vendors/css/chosen.bootstrap.min.css',
    'resources/assets/theme/vendors/css/bootstrap-datepicker3.min.css',
    //'resources/assets/theme/vendors/css/flatly.bootstrap-3.3.7.min.css',
    //'resources/assets/theme/vendors/css/flatly.bootstrap-4.min.css',
    "node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css",
    'node_modules/@fullcalendar/daygrid/main.css',

], 'public/css/vendors.css')


mix.browserSync('localhost:8000');

