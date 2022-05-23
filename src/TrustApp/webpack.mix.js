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

mix.react('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css');

// mix.js('resources/js/app.js', 'public/js')
//     .react()
//     .extract(['react'])
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

// mix.js('src/app.js', 'dist').setPublicPath('dist');

//mix.js('resources/js/app.js', 'public/js').sourceMaps();



