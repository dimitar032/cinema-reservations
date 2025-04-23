let mix = require('laravel-mix');
mix.webpackConfig({devtool: "source-map"});

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

 mix.sass('resources/assets/sass/app.scss', 'public/css');


//Vue apps
mix.js('resources/assets/js/vue/apps/manage_seats.js', 'public/js/vue/');
mix.js('resources/assets/js/vue/apps/movie_projections.js', 'public/js/vue/');
mix.js('resources/assets/js/vue/apps/employee_projections.js', 'public/js/vue/');
