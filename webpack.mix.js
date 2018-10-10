let mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    // .sourceMaps();

if ( ! mix.inProduction() ) {
    mix.browserSync({
        proxy: 'http://127.0.0.1:8000'
    });
}