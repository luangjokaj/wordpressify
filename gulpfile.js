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
var del = require('del');
var fs = require('fs');
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	PostCSS Plugins
 ------------------------------------------------------------------------------------------------- */
var pluginsDev = [
	partialimport,
	cssnext()
];
var pluginsProd = [
	partialimport,
	cssnext({warnForDuplicates: false})
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
	'copy-tmp-content',
	'copy-theme-dev',
	'copy-fonts-dev',
	'copy-content',
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

gulp.task('build-prod', [
	'copy-tmp-content',
	'copy-theme-prod',
	'copy-fonts-prod',
	'style-prod',
	'header-scripts-prod',
	'footer-scripts-prod'
]);

gulp.task('default');

gulp.task('cleanup', function () {
	del(['dist/**']);
});

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

gulp.task('copy-config', function () {
	gulp.src("src/wp-config.php")
		.pipe(gulp.dest('dist/wordpress/'))
});

gulp.task('set-config', function () {
	gulp.src("dist/wordpress/wp-config.php")
		.pipe(gulp.dest('src'))
});


gulp.task('copy-content', function () {
	gulp.src("src/uploads/**")
		.pipe(gulp.dest('dist/wordpress/wp-content/uploads'))
});

gulp.task('copy-tmp-content', function () {
	gulp.src("tmp/**").pipe(gulp.dest('src'));
});

gulp.task('clean-tmp', ['copy-tmp-content'], function () {
	return del(['tmp/**']);
});

gulp.task('copy-new-content', function () {
	gulp.src("dist/wordpress/wp-content/uploads/**")
		.pipe(gulp.dest('tmp/uploads'));
});

gulp.task('setup', [
	'unzip-wordpress',
	'copy-config'
]);

gulp.task('copy-theme-dev', function () {
	gulp.src("src/theme/**")
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName));
});

gulp.task('copy-theme-prod', function () {
	gulp.src("src/theme/**")
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('copy-fonts-dev', function () {
	gulp.src("src/fonts/**")
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName + '/fonts'))
});

gulp.task('copy-fonts-prod', function () {
	gulp.src("src/fonts/**")
		.pipe(gulp.dest('dist/themes/' + themeName + '/fonts'))
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

gulp.task('style-prod', function () {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(postcss(pluginsProd))
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('header-scripts-dev', function () {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(concat('header-bundle.js'))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest('dist/wordpress/wp-content/themes/' + themeName));
});

gulp.task('header-scripts-prod', function () {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('header-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName));
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

gulp.task('footer-scripts-prod', function () {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName));
});

var onError = function (err) {
	gutil.beep();
	console.log(err.toString());
	this.emit('end');
};

var reload = browserSync.reload();

gulp.task('reload-js', ['copy-fonts-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-fonts', ['footer-scripts-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-theme', ['copy-theme-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-content', ['copy-content'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('watch', function () {
	gulp.watch(['src/style/**/*.css'], ['style-dev']);
	gulp.watch(['src/js/**'], ['reload-js']);
	gulp.watch(['src/fonts/**'], ['reload-fonts']);
	gulp.watch(['src/theme/**'], ['reload-theme']);
	gulp.watch(['src/uploads/**'], ['reload-content']);
	gulp.watch(['dist/wordpress/**'], ['copy-new-content']);
	gulp.watch(['dist/wordpress/*.php'], ['set-config']);
});
/* -------------------------------------------------------------------------------------------------
	End of Build Tasks
 ------------------------------------------------------------------------------------------------- */
