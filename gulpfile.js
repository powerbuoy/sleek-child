const gulp = require('gulp');
const gulpSass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const cleanCss = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const clean = require('gulp-clean');
const fontello = require('gulp-fontello');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const gulpGettext = require('gulp-gettext');
const browserify = require('browserify');
const vinylSourceStream = require('vinyl-source-stream');
const vinylBuffer = require('vinyl-buffer');
const uglify = require('gulp-uglify');

/////////
// Assets
function cleanAssets () {
	return gulp.src('dist/assets/', {read: false, allowEmpty: true}).pipe(clean());
}

function copyAssets () {
	return gulp.src('src/assets/**/*').pipe(gulp.dest('dist/assets/'));
}

gulp.task('assets', gulp.series(cleanAssets, copyAssets));

////////
// Icons
function downloadIcons () {
	return gulp.src('icons.json').pipe(fontello()).pipe(gulp.dest('dist/icons/'));
}

function rewriteIconCSS () {
	var afterClass = 'icon--after';

	var baseFind = /\[class\^="icon-"\]:before, \[class\*=" icon-"\]:before/g;
	var baseReplace = '[class^="icon-"]:before, [class*=" icon-"]:before,\n[class^="icon-"]:after, [class*=" icon-"]:after';

	var iconFind = /\.icon-(.*?):before {(.*?)}/g;
	var iconReplace = '.icon-$1:before {$2}\n.icon-$1.' + afterClass + ':before {content: normal}\n.icon-$1.' + afterClass + ':after {$2}';

	var pathFind = /\.\.\/font\/fontello/g;
	var pathReplace = 'icons/font/fontello';

	return gulp.src('dist/icons/css/fontello.css')
		.pipe(replace(baseFind, baseReplace))
		.pipe(replace(iconFind, iconReplace))
		.pipe(replace(pathFind, pathReplace))
		.pipe(rename('icons.scss'))
		.pipe(gulp.dest('src/sass/'));
}

function generateIconVars () {
	var find = /\.icon-(.*?):before \{ content: '(.*?)'; \} \/\*.*?\*\//g;
	var rep = '\$icon-$1: "$2";';

	return gulp.src('dist/icons/css/fontello-codes.css').pipe(replace(find, rep)).pipe(rename('icon-vars.scss')).pipe(gulp.dest('src/sass/'));
}

gulp.task('icons', gulp.series(downloadIcons, rewriteIconCSS, generateIconVars));

///////
// SASS
function sass () {
	return gulp.src('src/sass/all.scss')
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(sassGlob())
		.pipe(gulpSass())
		.pipe(autoprefixer({
			overrideBrowserslist: ['last 1 version', 'IE 9', 'IE 10', '> 2%', 'Safari >= 8'],
			grid: true
		}))
		// .pipe(cssnano()) // NOTE: Causes issues :/
		.pipe(cleanCss())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('dist/'));
};

gulp.task('sass-only', sass);
gulp.task('sass', gulp.series(downloadIcons, rewriteIconCSS, generateIconVars, sass));

//////////
// Gettext
function gettext () {
	return gulp.src('languages/**/*.po').pipe(gulpGettext()).pipe(gulp.dest('languages/'));
}

gulp.task('gettext', gettext);

/////////////
// JavaScript
function js () {
	return browserify('src/js/all.js', {debug: true})
		.transform({global: true}, 'browserify-shim')
		.transform('require-globify')
		.bundle()
		.pipe(vinylSourceStream('all.js'))
		.pipe(vinylBuffer())
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(uglify())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('dist/'));
}

gulp.task('js', js);

//////////
// Default
gulp.task('default', gulp.parallel('gettext', 'assets', 'sass', 'js'));

////////
// Watch
function watchFiles () {
	gulp.watch('src/sass/**/*.scss', sass);
	gulp.watch('acf/**/*.scss', sass);
	gulp.watch('src/js/**/*.js', js);
	gulp.watch('acf/**/*.js', js);
	gulp.watch('icons.json', gulp.series(downloadIcons, rewriteIconCSS, generateIconVars, sass));
	gulp.watch('languages/**/*.po', gettext);
	gulp.watch('src/assets/**/*', gulp.series(cleanAssets, copyAssets));
}

gulp.task('watch', gulp.series('default', watchFiles));
