const {src, dest, watch, parallel} = require('gulp');

const scss = require('gulp-sass')(require('sass')); 
const concat = require('gulp-concat'); 
const uglify = require('gulp-uglify-es').default; 
const browserSync = require('browser-sync').create();
const autoprefixer = require("gulp-autoprefixer");

function scripts(){
    return src([
        'js/*.js',
        '!js/main.min.js'
    ])
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(dest('*/js'))
    .pipe(browserSync.stream())
}

function convert(){
    return src('scss/*.scss')
    .pipe(
        autoprefixer({
          overrideBrowserslist: ["last 4 versions"],
        })
      )
    .pipe(scss({outputStyle:'compressed'}))
    .pipe(dest('css'))
    .pipe(browserSync.stream())
}

function styles() {
    return src('scss/*.scss')
    .pipe(
        autoprefixer({
          overrideBrowserslist: ["last 4 versions"],
        })
      )
    .pipe(concat('style.min.css'))
    .pipe(scss({outputStyle:'compressed'}))
    .pipe(dest('css'))
    .pipe(browserSync.stream())
} //styles convert

function watching(){
    watch(['scss/*.scss'],convert)
    watch(['scss/*.scss'],styles)
    watch(['js/*.js'],scripts)
    watch(['**/*.php']).on('change', browserSync.reload)
}

function browsersync(){
    browserSync.init({
        server:{
            baseDir:"./"
        }
    });
}
exports.styles = styles;
exports.convert = convert;
exports.scripts = scripts;
exports.watching = watching;
exports.browsersync = browsersync;

exports.default = parallel(styles, convert, scripts, browsersync, watching);

