// Require tools
var gulp    = require('gulp');
var cssnano = require('gulp-cssnano');
var concatcss = require('gulp-concat-css');
var elixir  = require('laravel-elixir');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var rename = require('gulp-rename');

// require elixir settings
require('./../settings');

gulp.task('_libCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/app.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(plumber())
        .pipe(concatcss('app.css'))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css'));
});

gulp.task('_intranetCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/intranet/*.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css/intranet'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css/intranet/'));
});

gulp.task('_portalCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/portal/*.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css/portal'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css/portal/'));
});

gulp.task('_homeCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/homepage/*.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css/homepage'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css/homepage/'));
});

gulp.task('_vcoachCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/vcoach/*.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css/vcoach'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css/vcoach/'));
});

gulp.task('_docsCss', function () {
    return gulp
        .src([
            elixir.config.assetsPath + '/sass/docs/*.scss',
        ])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(elixir.config.paths.public + '/raw/css/docs'))
        .pipe(cssnano({
            keepSpecialComments: 0
        }))
        .pipe(rename({
            suffix: ".min"
        }))
        .pipe(gulp.dest(elixir.config.paths.public + '/dist/css/docs/'));
});
