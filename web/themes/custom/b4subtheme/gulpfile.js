const gulp = require('gulp');
const { src, dest, watch, series, parallel } = require('gulp');
const imagemin = require('gulp-imagemin');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const terser = require('gulp-terser');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');

const paths = {
  styles: {
    src: ['./scss/*.scss'],
    dest: './css/',
  },
};

function compileStyles() {
  return src(paths.styles.src)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    // .pipe(postcss([autoprefixer(), cssnano()]))
    // .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.styles.dest));
}

function watcher() {
  watch(paths.styles.src, compileStyles);
 }

exports.compileStyles = compileStyles;
exports.watcher = watcher;

exports.default = series(
  compileStyles,
  watcher
);
