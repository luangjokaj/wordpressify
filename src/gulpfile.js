/* -------------------------------------------------------------------------------------------------

	Build Configuration
	Contributors: Luan Gjokaj

 ------------------------------------------------------------------------------------------------- */
'use strict';
var gulp = require('gulp');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var postcss = require('gulp-postcss');
var cssnext = require('postcss-cssnext');
var partialimport = require('postcss-easy-import');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('cssnano');
var plumber = require('gulp-plumber');
var babel = require("gulp-babel");
var livereload = require("gulp-livereload");
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	PostCSS Plugins
 ------------------------------------------------------------------------------------------------- */
var pluginsDev = [
	partialimport,
	cssnext()
];
//--------------------------------------------------------------------------------------------------
var headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/aos/dist/aos.js'
];
var footerJS = [
	'js/**'
];
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	Start of Build Tasks
 ------------------------------------------------------------------------------------------------- */
gulp.task('build-dev', [
	'style-dev',
	'header-scripts-dev',
	'footer-scripts-dev',
	'watch'
]);

gulp.task('default');

gulp.task('style-dev', function () {
	return gulp.src('style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(postcss(pluginsDev))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('/Applications/MAMP/htdocs/goldengate/wp-content/themes/goldengate'));
});

gulp.task('header-scripts-dev', function () {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(concat('header-bundle.js'))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest('/Applications/MAMP/htdocs/goldengate/wp-content/themes/goldengate/js'));
});

gulp.task('footer-scripts-dev', function () {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest('/Applications/MAMP/htdocs/goldengate/wp-content/themes/goldengate/js'));
});

var onError = function (err) {
	gutil.beep();
	console.log(err.toString());
	this.emit('end');
};

gulp.task('watch', function () {
	livereload.listen();
	gulp.watch(['style/**/*.css'], ['style-dev'], function (files) {
		livereload.changed(files);
	});
	gulp.watch(['js/**'], ['footer-scripts-dev']);
});
/* -------------------------------------------------------------------------------------------------
	End of Build Tasks
 ------------------------------------------------------------------------------------------------- */
