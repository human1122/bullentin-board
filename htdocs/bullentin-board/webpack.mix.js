// マッピング
const mix = require('laravel-mix');
const MixGlob = require('laravel-mix-glob');

const mixGlob = new MixGlob({ mix });

mixGlob.js('resources/js/**/*.compile.js', 'public/js', null, {
    base: 'resources/js/'
}).sass('resources/sass/**/*.compile.scss', 'public/css', null, {
    base: 'resources/sass/'
});

// 一意のキー付与
mix.version();