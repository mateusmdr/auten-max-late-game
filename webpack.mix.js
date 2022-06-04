const path = require('path');

const mix = require('laravel-mix');
require('mix-env-file');
require('laravel-mix-simple-image-processing')

mix
    .imgs({
        source: 'resources/images/raw',
        destination: 'resources/images',
    })
    .js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/public.scss', 'public/css')
    .sass('resources/sass/global.scss', 'public/css')
    .alias({
        '@images': path.join(__dirname, 'resources/images'),
    })
    .copy('resources/images/dark_logo.png', 'public/images');

if (mix.inProduction()) {
    mix
        .version()
        .sourceMaps()
}else {
    mix.browserSync(process.env.APP_URL);
}