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

//mix.setPublicPath(path.resolve('./public'))

mix.sass('resources/sass/frontend/app.scss', './public/css/frontend.css')
    .sass('resources/sass/backend/app.scss', './public/css/backend.css')
    .js('resources/js/frontend/app.js', './public/js/frontend.js')
    .js([
        'resources/js/backend/before.js',
        'resources/js/backend/app.js',
        'resources/js/backend/after.js',
    ], './public/js/backend.js')
    .extract([
        'jquery',
        'bootstrap',
        'popper.js/dist/umd/popper',
        'axios',
        'sweetalert2',
        'lodash',
        '@fortawesome/fontawesome-svg-core',
        '@fortawesome/free-brands-svg-icons',
        '@fortawesome/free-regular-svg-icons',
        '@fortawesome/free-solid-svg-icons'
    ]);

//mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}
