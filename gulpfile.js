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
var babel = require('gulp-babel');
var remoteSrc = require('gulp-remote-src');
var unzip = require('gulp-unzip');
var zip = require('gulp-zip');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
var inject = require('gulp-inject-string');
var del = require('del');
var fs = require('fs');
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	PostCSS Plugins
 ------------------------------------------------------------------------------------------------- */
var pluginsDev = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];
var pluginsProd = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];
//--------------------------------------------------------------------------------------------------
var headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/nprogress/nprogress.js',
	'node_modules/aos/dist/aos.js',
	'node_modules/isotope-layout/dist/isotope.pkgd.js'
];
var footerJS = [
	'src/js/**'
];
/* -------------------------------------------------------------------------------------------------
	Theme Name
 ------------------------------------------------------------------------------------------------- */
var themeName = 'wordpressify';
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
	Start of Build Tasks
 ------------------------------------------------------------------------------------------------- */
gulp.task('build-dev', [
	'copy-theme-dev',
	'copy-fonts-dev',
	'style-dev',
	'header-scripts-dev',
	'footer-scripts-dev',
	'watch'

], function () {
	connect.server({
		base: 'build/wordpress',
		port: '3020'
	}, function () {
		browserSync({
			proxy: '127.0.0.1:3020'
		});
	});
});

gulp.task('build-prod', [
	'copy-theme-prod',
	'copy-fonts-prod',
	'style-prod',
	'header-scripts-prod',
	'footer-scripts-prod',
	'zip-theme'
]);

gulp.task('default');

gulp.task('cleanup', function () {
	del(['build/**']);
	del(['dist/**']);
});

gulp.task('dist', function () {
	gulp.src('build/wordpress/wp-content/themes/' + themeName + '/**')
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('zip-theme', ['copy-theme-prod', 'copy-fonts-prod', 'style-prod', 'header-scripts-prod', 'footer-scripts-prod'], function () {
	gulp.src('dist/themes/' + themeName + '/**')
		.pipe(zip(themeName + '.zip'))
		.pipe(gulp.dest('dist'))
});

gulp.task('download-wordpress', function () {
	remoteSrc(['latest.zip'], {
		base: 'https://wordpress.org/'
	})
		.pipe(gulp.dest('build/'));
});

gulp.task('unzip-wordpress', function () {
	gulp.src('build/latest.zip')
		.pipe(unzip())
		.pipe(gulp.dest('build/'))
});

gulp.task('copy-config', function () {
	gulp.src('wp-config.php')
		.pipe(gulp.dest('build/wordpress'));
});

gulp.task('disable-cron', function () {
	gulp.src('build/wordpress/wp-config.php')
		.pipe(inject.after('define(\'DB_COLLATE\', \'\');', '\ndefine(\'DISABLE_WP_CRON\', true);'))
		.pipe(gulp.dest('build/wordpress'));
});

gulp.task('setup', [
	'unzip-wordpress',
	'copy-config'
]);

var date = new Date().toLocaleDateString('en-GB').replace(/\//g, '.');

gulp.task('backup', function () {
	gulp.src('build/wordpress/**')
		.pipe(zip(date + '.zip'))
		.pipe(gulp.dest('backups'));
});

gulp.task('copy-theme-dev', function () {
	gulp.src('src/theme/**')
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName));
});

gulp.task('copy-theme-prod', function () {
	gulp.src('src/theme/**')
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('copy-fonts-dev', function () {
	gulp.src('src/fonts/**')
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/fonts'))
});

gulp.task('copy-fonts-prod', function () {
	gulp.src('src/fonts/**')
		.pipe(gulp.dest('dist/themes/' + themeName + '/fonts'))
});

gulp.task('style-dev', function () {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(postcss(pluginsDev))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName))
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
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/js'));
});

gulp.task('header-scripts-prod', function () {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('header-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

gulp.task('footer-scripts-dev', function () {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/js'));
});

gulp.task('footer-scripts-prod', function () {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

var onError = function (err) {
	gutil.beep();
	console.log(err.toString());
	this.emit('end');
};

gulp.task('reload-js', ['footer-scripts-dev', 'header-scripts-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-fonts', ['copy-fonts-dev'], function (done) {
	browserSync.reload();
	done();
});

gulp.task('reload-theme', ['copy-theme-dev'], function (done) {
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
