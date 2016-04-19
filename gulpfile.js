var gulp = require('gulp');

var paths = {
	sass: __dirname + '/src/sass/',
	js: __dirname + '/src/js/',
	dest: __dirname + '/dist/',
	icons: __dirname + '/dist/icons/'
};

/**
 * SASS
 */
var sleekSASS = require(__dirname + '/../sleek/gulp/sass.js');

gulp.task('sass', ['icons'], function () {
	sleekSASS(paths.sass + 'all.scss', paths.dest);
});

gulp.task('sass-only', function () {
	sleekSASS(paths.sass + 'all.scss', paths.dest);
});

/**
 * Icons
 */
var sleekIcons = require(__dirname + '/../sleek/gulp/icons.js');

gulp.task('rewrite-icon-css', ['download-icons'], function () {
	sleekIcons.rewriteCSS(paths.icons, paths.sass);
});

gulp.task('download-icons', function () {
	sleekIcons.download('icons.json', paths.icons);
});

gulp.task('icons', ['rewrite-icon-css']);

/**
 * JS
 */
var sleekJS = require(__dirname + '/../sleek/gulp/js.js');
var sleekJSHint = require(__dirname + '/../sleek/gulp/jshint.js');

gulp.task('js', ['js-hint'], function () {
	sleekJS(paths.js, paths.dest);
});

gulp.task('js-hint', function () {
	sleekJSHint(paths.js);
});

/**
 * Styleguide
 * (commented because since we moved sass/ to src/sass/ the styleguide for some
 * fucked up reason gets generated in the parent directory of sleek-child?!)
 */
/* var sleekStyleguide = require(__dirname + '/../sleek/gulp/styleguide.js');

gulp.task('styleguide', function () {
	sleekStyleguide(paths.sass + 'all.scss', paths.dest);
}); */

/**
 * Watch and default
 */
gulp.task('default', ['sass', 'js'/*, 'styleguide'*/]);

gulp.task('watch', function () {
	gulp.watch(paths.sass + '**/*.scss', ['sass-only']);
	gulp.watch(paths.js + '**/*.js', ['js']);
	gulp.watch(__dirname + '/icons.json', ['sass']);
});
