/**
 * NPM modules
 */
 var gulp = require('gulp');
 var sass = require('gulp-sass');
 var sourcemaps = require('gulp-sourcemaps');
 var autoprefixer = require('gulp-autoprefixer');
 var minifyCSS = require('gulp-minify-css');

 /**
  * Paths
  */
 var paths = {
     sass: 'sass/',
     js: 'js/',
     dest: 'public/'
 };

 /**
  * Compile SASS and run autoprefixer
  */
 var doSASS = function (file) {
     return gulp.src(paths.sass + file)
         .pipe(sourcemaps.init())
         .pipe(sass())
         .pipe(autoprefixer({
             browsers: ['last 1 version', 'IE 9', '> 2%']
         }))
         .pipe(minifyCSS({
             advanced: false
         }))
         .pipe(sourcemaps.write('./'))
         .pipe(gulp.dest(paths.dest));
 };

 gulp.task('sass', function () {
     doSASS('all.scss');
 });

/**
 * Watch
 */
gulp.task('watch', function () {
    gulp.watch(paths.sass + '**/*.scss', ['sass']);
});
