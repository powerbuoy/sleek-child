/**
 * Paths
 */
var paths = {
	sass: 'sass/',
	js: 'js/',
	dest: 'public/',
	icons: 'public/icons/'
};

/**
 * Compile SASS and run autoprefixer
 */
var doSASS = require('../sleek/gulp/sass.js');

gulp.task('sass', ['icons'], function () {
	doSASS(paths.sass + 'all.scss');
});

gulp.task('sass-only', function () {
	doSASS(paths.sass + 'all.scss');
});
