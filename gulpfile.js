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
var remoteSrc = require('gulp-remote-src');
var unzip = require('gulp-unzip');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
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
	'src/js/**'
];

/* -------------------------------------------------------------------------------------------------
	Theme Name
 ------------------------------------------------------------------------------------------------- */
var themeName = 'goldengate';
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	Start of Build Tasks
 ------------------------------------------------------------------------------------------------- */
gulp.task('build-dev', [
	'download-wordpress',
	'unzip-wordpress',
	'copy-theme',
	'copy-fonts',
	'style-dev',
	'header-scripts-dev',
	'footer-scripts-dev',
	'watch'

], function () {
	connect.server({
		base: 'dist/wordpress',
		port: '3020'
	}, function (){
		browserSync({
			proxy: '127.0.0.1:3020'
		});
	});
});

gulp.task('default');

gulp.task('download-wordpress', function () {
	remoteSrc(['latest.zip'], {
		base: 'https://wordpress.org/'
	})
	.pipe(gulp.dest('dist/'));
});

gulp.task('unzip-wordpress', function () {
	gulp.src("dist/latest.zip")
		.pipe(unzip())
		.pipe(gulp.dest('dist/'))
});

gulp.task('copy-theme', function () {
	gulp.src("src/theme/**")
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName))
});

gulp.task('copy-fonts', function () {
	gulp.src("src/fonts/**")
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName + '/fonts'))
});

gulp.task('style-dev', function () {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(postcss(pluginsDev))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName))
		.pipe(browserSync.stream({ match: '**/*.css' }));
});

gulp.task('header-scripts-dev', function () {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(concat('header-bundle.js'))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName));
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
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName));
});

var onError = function (err) {
	gutil.beep();
	console.log(err.toString());
	this.emit('end');
};

var reload = browserSync.reload();

gulp.task('reload-js', ['copy-fonts'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-fonts', ['footer-scripts-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-theme', ['copy-theme'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('watch', function () {
	gulp.watch(['src/style/**/*.css'], ['style-dev']);
	gulp.watch(['src/js/**'], ['reload-js']);
	gulp.watch(['src/fonts/**'], ['reload-fonts']);
	gulp.watch(['src/theme/**'], ['reload-theme']);
});
/* -------------------------------------------------------------------------------------------------
	End of Build Tasks
 ------------------------------------------------------------------------------------------------- */
