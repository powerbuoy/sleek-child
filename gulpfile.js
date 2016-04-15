<<<<<<< HEAD
var gulp = require('gulp');

var paths = {
	sass: 'sass/',
	js: 'js/',
	dest: 'public/',
	icons: 'public/icons/'
};

/**
 * SASS
 */
var sleekSASS = require('../sleek/gulp/sass.js');

gulp.task('sass', ['icons'], function () {
	sleekSASS(paths.sass + 'all.scss', paths.dest);
});

gulp.task('sass-only', function () {
	sleekSASS(paths.sass + 'all.scss', paths.dest);
});

/**
 * Icons
 */
var sleekIcons = require('../sleek/gulp/icons.js');

gulp.task('rewrite-icon-css', ['download-icons'], function () {
	sleekIcons.rewriteCSS(paths.icons, paths.sass);
});

gulp.task('download-icons', function () {
	sleekIcons.download('icons.json', paths.icons);
=======
/**
 * Gulp modules
 */
var gulp = require('gulp');
var plumber = require('gulp-plumber');

// SASS
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');

// Icons
var fontello = require('gulp-fontello');
var replace = require('gulp-replace');

// JS
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var jsHint = require('gulp-jshint');

// Browserify
var through = require('through2');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var gutil = require('gulp-util');
var globby = require('globby');
var browserify = require('browserify');

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
var doSASS = function (file) {
    return gulp.src(paths.sass + file)
        .pipe(plumber())
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

gulp.task('sass', ['icons'], function () {
    doSASS('all.scss');
});

gulp.task('sass-only', function () {
    doSASS('all.scss');
});

/**
 * Fetch icons from Fontello.com
 */
gulp.task('download-icons', function () {
    return gulp.src('icons.json')
        .pipe(fontello())
        .pipe(gulp.dest(paths.icons));
});

// Move the icon.css file into our SASS directory
gulp.task('move-icons', ['download-icons'], function () {
    return gulp.src(paths.icons + 'css/fontello.css').pipe(gulp.dest(paths.sass));
});

// We need to change some paths etc now that icons have moved
// Also add support for .icon--after
gulp.task('rewrite-icon-css', ['move-icons'], function () {
    var afterClass = 'icon--after';

    var iconFind = /\.icon-(.*?):before {(.*?)}/g;
    var iconReplace = '.icon-$1:before {$2}\n.icon-$1.' + afterClass + ':before {content: normal}\n.icon-$1.' + afterClass + ':after {$2}';

    var baseFind = /\[class\^="icon-"\]:before, \[class\*=" icon-"\]:before/g;
    var baseReplace = '[class^="icon-"]:before, [class*=" icon-"]:before,\n[class^="icon-"]:after, [class*=" icon-"]:after';

    var pathFind = /\.\.\/font\/fontello/g;
    var pathReplace = 'icons/font/fontello';

    return gulp.src(paths.sass + 'fontello.css')
        .pipe(replace(baseFind, baseReplace))
        .pipe(replace(iconFind, iconReplace))
        .pipe(replace(pathFind, pathReplace))
        .pipe(gulp.dest(paths.sass));
>>>>>>> 38a103507eb57280b105e4d7f67f99aebdb1db20
});

gulp.task('icons', ['rewrite-icon-css']);

/**
<<<<<<< HEAD
 * Styleguide
 */
var sleekStyleguide = require('../sleek/gulp/styleguide.js');

gulp.task('styleguide', function () {
	sleekStyleguide(paths.sass + 'all.scss', paths.dest);
});

/**
 * JS
 */
var sleekJS = require('../sleek/gulp/js.js');
var sleekJSHint = require('../sleek/gulp/jshint.js');

gulp.task('js', ['js-hint'], function () {
	sleekJS(paths.js, paths.dest);
});

gulp.task('js-hint', function () {
	sleekJSHint(paths.js);
});

 /**
  * Watch and default
  */
 gulp.task('default', ['sass', 'js', 'styleguide']);

 gulp.task('watch', function () {
 	gulp.watch(paths.sass + '**/*.scss', ['sass-only']);
 	gulp.watch(paths.js + '**/*.js', ['js']);
 	gulp.watch('icons.json', ['sass']);
 });
=======
 * Merge JS-files
 */
var doJS = function () {
    return gulp.src(paths.js + '**/*.js')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(uglify({
            mangle: false
        }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.dest));
};

var doBrowserify = function (src, dst) {
    // gulp expects tasks to return a stream, so we create one here.
    var bundledStream = through();

    bundledStream
        // turns the output bundle stream into a stream containing
        // the normal attributes gulp plugins expect.
        .pipe(source(dst))

        // the rest of the gulp task, as you would normally write it.
        // here we're copying from the Browserify + Uglify2 recipe.
        .pipe(buffer())
        .pipe(sourcemaps.init({loadMaps: true}))

        // Add gulp plugins to the pipeline here.
        .pipe(uglify())
        .on('error', gutil.log)
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.dest));

        // "globby" replaces the normal "gulp.src" as Browserify
        // creates it's own readable stream.
        globby([src + '*.js']).then(function(entries) {
            // create the Browserify instance.
            var b = browserify({
                entries: entries,
                debug: true
            })
            .transform({global: true}, 'browserify-shim');

            // pipe the Browserify stream into the stream we created earlier
            // this starts our gulp pipeline.
            b.bundle().pipe(bundledStream);
        })
        .catch(function(err) {
            // ensure any errors from globby are handled
            bundledStream.emit('error', err);
        });

    // finally, we return the stream, so gulp knows when this task is done.
    return bundledStream;
};

gulp.task('js', ['js-hint'], function () {
    // doJS();
    doBrowserify(paths.js, 'app.js');
});

/**
 * JSHint
 */
gulp.task('js-hint', function () {
    return gulp.src(paths.js + '**/*.js')
        .pipe(jsHint({
            // undef: true, // To check undefined vars
            curly: true,
            forin: true,
            freeze: true,
            latedef: true,
            strict: true,
            unused: true
        }))
        .pipe(jsHint.reporter('jshint-stylish'))
        .pipe(jsHint.reporter('fail'));
});

/**
 * Watch and default
 */
gulp.task('default', ['sass', 'js']);

gulp.task('watch', function () {
    gulp.watch(paths.sass + '**/*.scss', ['sass-only']);
    gulp.watch(paths.js + '**/*.js', ['js']);
    gulp.watch('icons.json', ['sass']);
});
>>>>>>> 38a103507eb57280b105e4d7f67f99aebdb1db20
