'use strict';
const gulp = require('gulp'),
    browserSync = require('browser-sync').create(), // Обновляет страницу
    less = require('gulp-less'), // Компиляция .less в .css
    plumber = require('gulp-plumber'), // Удерживает консоль в рабочем состоянии при ошибке
    cleanCSS = require('gulp-clean-css'), // Минифицирование фалов .css
    postCss = require('gulp-postcss'), // Поддержка верстки в Explorer(кроссбраузерность)
    sourceMaps = require('gulp-sourcemaps'), // Расстановка карт
    rename = require('gulp-rename'), // Переименование файлов
    imagemin = require('gulp-imagemin'), // Сжатие png jpeg jpg gif
    autoPrefix = require('autoprefixer'), // Расставляет префиксы в .css(кроссбраузерность)
    uglify = require('gulp-uglify'), // Минификация JS
    pump = require('pump'); // Доп. пакет для minifier(js)

gulp.task('connect', function () {
    browserSync.init({
        proxy: "https://localhost/", // проксирование вашего удаленного сервера, не важно на чем back-end
        logPrefix: 'localhost', // префикс для лога bs, маловажная настройка
        host: 'localhost', // можно использовать ip сервера
        port: 3000, // порт через который будет проксироваться сервер
        open: 'external', // указываем, что наш url внешний
        notify: true,
        ghost: true,
        files: ['./**/*.php'] // [/*массив с путями к файлам и папкам за которыми вам нужно следить*/]
    });
    gulp.watch([
        'template/**/*.less'
    ], ['build']);
    gulp.watch([
        'template/**/*.php'
    ], ['watchPhp']);
    gulp.watch([
        'template/**/main.js'
    ], ['watchJs']);
});

gulp.task('watchPhp', function () {
    browserSync.reload();
});

gulp.task('watchJs', function (cb) {
    pump([
        gulp.src('template/**/main.js'),
        plumber(),
        uglify(),
        rename({suffix: '.min'}),
        gulp.dest('template/')
    ], cb);
    browserSync.reload();
});

gulp.task('reduce', function () {
    gulp.src('template/images/*.*')
        .pipe(plumber())
        .pipe(imagemin({
            interlaced: true,
            progressive: true,
            optimizationLevel: 5,
            svgoPlugins: [{removeViewBox: true}]
        }))
        .pipe(gulp.dest('template/images/'));
});

gulp.task('build', function () {
    gulp.src('template/**/*.less')
        .pipe(plumber())
        .pipe(less())
        .pipe(cleanCSS({debug: true}, function (details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(sourceMaps.init())
        .pipe(postCss([autoPrefix({browsers: ['> 1%', 'IE 7'], cascade: false})]))
        .pipe(sourceMaps.write('.'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('template/'));
    browserSync.reload();
});

gulp.task('default', ['connect', 'build', 'watchPhp', 'watchJs']);