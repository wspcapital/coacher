const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');


// Require custom elixir settings and extensions
require('./resources/assets/elixir/settings');
require('./resources/assets/elixir/extensions/build');

// Require elixir plugins
require('laravel-elixir-clear');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// Mix 'em
elixir(function (mix) {

    // Build
    mix
        .task('_libCss')
        .task('_intranetCss')
        .task('_portalCss')
        .task('_homeCss')
        .task('_vcoachCss')
        .task('_docsCss')
        .copy(
            elixir.config.assetsPath + '/img',
            elixir.config.paths.public + '/dist/img'
        )
        .copy(
            elixir.config.assetsPath + '/cms',
            elixir.config.paths.public + '/dist/cms'
        )
        .copy(
            elixir.config.assetsPath + '/fonts',
            elixir.config.paths.public + '/dist/fonts'
        )
        .copy(
            elixir.config.assetsPath + '/libs',
            elixir.config.paths.public + '/dist/libs'
        )
        .copy(
            elixir.config.assetsPath + '/lessons',
            elixir.config.paths.public + '/dist/lessons'
        )
        .copy(
            elixir.config.assetsPath + '/static',
            elixir.config.paths.public + '/static'
        );
});

// Watch files for changes
gulp.task('watch', function () {
    // Less
    gulp.watch(
        elixir.config.assetsPath + '/sass/**/*.scss',
        ['_intranetCss', '_portalCss', '_homeCss', '_vcoachCss', '_docsCss']
    );
});


