var gulp = require('gulp');

var paths = {
	sass: 'src/sass/',
	js: 'src/js/',
	dest: 'dist/',
	icons: 'dist/icons/',
	lang: 'languages/',
	assets: 'src/assets/'
};

/**
 * SASS
 */
var sleekSASS = require(__dirname + '/../sleek/gulp/sass.js');

gulp.task('sass', ['icons', 'svg'], function () {
	return sleekSASS(paths.sass + 'all.scss', paths.dest);
});

gulp.task('sass-only', function () {
	return sleekSASS(paths.sass + 'all.scss', paths.dest);
});

/**
 * Icons
 */
var sleekIcons = require(__dirname + '/../sleek/gulp/icons.js');

gulp.task('generate-icon-vars', ['rewrite-icon-css'], function () {
	return sleekIcons.generateIconVars(paths.icons, paths.sass);
});

gulp.task('rewrite-icon-css', ['download-icons'], function () {
	return sleekIcons.rewriteCSS(paths.icons, paths.sass);
});

gulp.task('download-icons', function () {
	return sleekIcons.download('icons.json', paths.icons);
});

gulp.task('icons', ['generate-icon-vars']);

/**
 * JS
 */
var sleekJS = require(__dirname + '/../sleek/gulp/js.js');
var sleekJSHint = require(__dirname + '/../sleek/gulp/jshint.js');

gulp.task('js', ['js-hint'], function () {
	return sleekJS(paths.js, paths.dest);
});

gulp.task('js-hint', function () {
	return sleekJSHint(paths.js);
});

/**
 * Styleguide
 */
var sleekStyleguide = require(__dirname + '/../sleek/gulp/styleguide.js');

gulp.task('styleguide', ['sass'], function () {
	return sleekStyleguide(paths.sass + 'all.scss', paths.dest);
});


/**
 * GetText
 */
var sleekGetText = require(__dirname + '/../sleek/gulp/gettext.js');

gulp.task('gettext', function () {
	return sleekGetText(paths.lang);
});

/**
 * Copy Assets (TODO: Should delete first!)
 */
gulp.task('assets', function () {
	return gulp.src([paths.assets + '**/*', '!' + paths.assets + '**/*.svg']).pipe(gulp.dest(paths.dest + 'assets'));
});

/**
 * Merge and min SVGs
 */
var sleekSvg = require(__dirname + '/../sleek/gulp/svg.js');

gulp.task('svgmin', function () {
	return sleekSvg.min(paths.assets + '**/*.svg', paths.dest + 'assets');
});

gulp.task('svgstore', ['svgmin'], function () {
	return sleekSvg.store(paths.assets + '**/*.svg', paths.dest + 'assets');
});

gulp.task('svg', ['svgstore'], function () {
	return sleekSvg.css(paths.dest + '**/*.svg', paths.sass + 'svg.scss');
});

/**
 * Watch and default
 */
gulp.task('default', ['sass', 'js', 'gettext', 'assets', 'styleguide']);

gulp.task('watch', ['default'], function () {
	gulp.watch(paths.sass + '**/*.scss', ['sass-only']);
	gulp.watch(paths.js + '**/*.js', ['js']);
	gulp.watch('icons.json', ['sass']);
	gulp.watch(paths.lang + '**/*.po', ['gettext']);
	gulp.watch(paths.assets + '**/*', ['assets']);
	gulp.watch(paths.assets + '**/*.svg', ['sass']);
});
