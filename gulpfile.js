/* -------------------------------------------------------------------------------------------------

Build Configuration
Contributors: Luan Gjokaj, Adam McKenna, Mehdi Rezaei, Sören Wrede, Saneef Ansari

-------------------------------------------------------------------------------------------------- */
const babel = require('gulp-babel');
const browserSync = require('browser-sync');
const concat = require('gulp-concat');
const connect = require('gulp-connect-php');
const cssnano = require('cssnano');
const cssnext = require('postcss-cssnext');
const del = require('del');
const fs = require('fs');
const gulp = require('gulp');
const gutil = require('gulp-util');
const inject = require('gulp-inject-string');
const partialimport = require('postcss-easy-import');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const remoteSrc = require('gulp-remote-src');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const unzip = require('gulp-unzip');
const zip = require('gulp-zip');
const imagemin = require('gulp-imagemin');

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */
const themeName = 'wordpressify';

/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
-------------------------------------------------------------------------------------------------- */
const pluginsDev = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];
const pluginsProd = [
	partialimport,
	cssnext({
		features: {
			colorHexAlpha: false
		}
	})
];

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/nprogress/nprogress.js',
	'node_modules/aos/dist/aos.js',
	'node_modules/isotope-layout/dist/isotope.pkgd.js'
];
const footerJS = [
	'src/js/**'
];

/* -------------------------------------------------------------------------------------------------
Installation Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('default');

gulp.task('cleanup', () => {
	del(['build/**']);
	del(['dist/**']);
});

gulp.task('download-wordpress', () => {
	remoteSrc(['latest.zip'], {
		base: 'https://wordpress.org/'
	})
		.pipe(gulp.dest('build/'));
});

gulp.task('setup', [
	'unzip-wordpress',
	'copy-config'
]);

gulp.task('unzip-wordpress', () => {
	gulp.src('build/latest.zip')
		.pipe(unzip())
		.pipe(gulp.dest('build/'))
});

gulp.task('copy-config', () => {
	gulp.src('wp-config.php')
		.pipe(inject.after('define(\'DB_COLLATE\', \'\');', '\ndefine(\'DISABLE_WP_CRON\', true);'))
		.pipe(gulp.dest('build/wordpress'))
		.on('end', () => {
				gutil.beep();
				gutil.log(devServerReady);
				gutil.log(thankYou);
			});
});

gulp.task('disable-cron', () => {
	fs.readFile('build/wordpress/wp-config.php', (err, data) => {
		if (err) {
			gutil.log(wpFy + ' - ' + errorMsg + ' Something went wrong, WP_CRON was not disabled!');
			process.exit(1);
		}
		if (data.indexOf('DISABLE_WP_CRON') >= 0) {
			gutil.log('WP_CRON is already disabled!');
		} else {
			gulp.src('build/wordpress/wp-config.php')
				.pipe(inject.after('define(\'DB_COLLATE\', \'\');', '\ndefine(\'DISABLE_WP_CRON\', true);'))
				.pipe(gulp.dest('build/wordpress'));
		}
	});
});

/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('build-dev', [
	'copy-theme-dev',
	'copy-fonts-dev',
	'style-dev',
	'header-scripts-dev',
	'footer-scripts-dev',
	'plugins-dev',
	'watch'

], () => {
	connect.server({
		base: 'build/wordpress',
		port: '3020'
	}, () => {
		browserSync({
			proxy: '127.0.0.1:3020'
		});
	});
});

gulp.task('copy-theme-dev', () => {
	if (!fs.existsSync('./build')) {
		gutil.log(buildNotFound);
		process.exit(1);
	} else {
		gulp.src('src/theme/**')
			.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName));
	}
});

gulp.task('copy-fonts-dev', () => {
	gulp.src('src/fonts/**')
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/fonts'))
});

gulp.task('style-dev', () => {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(postcss(pluginsDev))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName))
		.pipe(browserSync.stream({ match: '**/*.css' }));
});

gulp.task('header-scripts-dev', () => {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(concat('header-bundle.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('build/wordpress/wp-content/themes/' + themeName + '/js'));
});

gulp.task('footer-scripts-dev', () => {
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

gulp.task('plugins-dev', () => {
	return gulp.src('src/plugins/**')
		.pipe(gulp.dest('build/wordpress/wp-content/plugins'));
});

gulp.task('reload-js', ['footer-scripts-dev', 'header-scripts-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-fonts', ['copy-fonts-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-theme', ['copy-theme-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('reload-plugins', ['plugins-dev'], (done) => {
	browserSync.reload();
	done();
});

gulp.task('watch', () => {
	gulp.watch(['src/style/**/*.css'], ['style-dev']);
	gulp.watch(['src/js/**'], ['reload-js']);
	gulp.watch(['src/fonts/**'], ['reload-fonts']);
	gulp.watch(['src/theme/**'], ['reload-theme']);
	gulp.watch(['src/plugins/**'], ['reload-plugins']);
	gulp.watch('build/wordpress/wp-config*.php', (event) => {
		if (event.type === 'added') { 
			gulp.start('disable-cron');
		}
	})
});

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */
gulp.task('build-prod', [
	'copy-theme-prod',
	'copy-fonts-prod',
	'style-prod',
	'header-scripts-prod',
	'footer-scripts-prod',
	'plugins-prod',
	'zip-theme'
]);

gulp.task('copy-theme-prod', () => {
	gulp.src(['src/theme/**', '!src/theme/img/**'])
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('copy-fonts-prod', () => {
	gulp.src('src/fonts/**')
		.pipe(gulp.dest('dist/themes/' + themeName + '/fonts'))
});

gulp.task('process-images', ['copy-theme-prod'], function () {
	return gulp.src('src/theme/img/**')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(imagemin([
			imagemin.svgo({ plugins: [{ removeViewBox: true }] })
		], {
			verbose: true
		}))
		.pipe(gulp.dest('dist/themes/' + themeName + '/img'));
});

gulp.task('style-prod', () => {
	return gulp.src('src/style/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(postcss(pluginsProd))
		.pipe(gulp.dest('dist/themes/' + themeName))
});

gulp.task('header-scripts-prod', () => {
	return gulp.src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('header-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

gulp.task('footer-scripts-prod', () => {
	return gulp.src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(babel({
			presets: ['env']
		}))
		.pipe(concat('footer-bundle.js'))
		.pipe(uglify())
		.pipe(gulp.dest('dist/themes/' + themeName + '/js'));
});

gulp.task('plugins-prod', () => {
	return gulp.src('src/plugins/**')
		.pipe(gulp.dest('dist/plugins'));
});

gulp.task('zip-theme', ['copy-theme-prod', 'copy-fonts-prod', 'process-images', 'style-prod', 'header-scripts-prod', 'footer-scripts-prod', 'plugins-prod'], () => {
	gulp.src('dist/themes/' + themeName + '/**')
		.pipe(zip(themeName + '.zip'))
		.pipe(gulp.dest('dist'))
		.on('end', () => {
			gutil.beep();
			gutil.log(pluginsGenerated);
			gutil.log(filesGenerated);
			gutil.log(thankYou);
		});
});

/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */
const onError = (err) => {
	gutil.beep();
	gutil.log(wpFy + ' - ' + errorMsg + ' ' + err.toString());
	this.emit('end');
};

const date = new Date().toLocaleDateString('en-GB').replace(/\//g, '.');
const errorMsg = '\x1b[41mError\x1b[0m';
const devServerReady = 'Your development server is ready, start the workflow with the command: $ \x1b[1mnpm run dev\x1b[0m';
const buildNotFound = errorMsg + ' ⚠️　- You need to install WordPress first. Run the command: $ \x1b[1mnpm run install:wordpress\x1b[0m';
const filesGenerated = 'Your ZIP template file was generated in: \x1b[1m' + __dirname + '/dist/' + themeName + '.zip\x1b[0m - ✅';
const pluginsGenerated = 'Plugins are generated in: \x1b[1m' + __dirname + '/dist/plugins/\x1b[0m - ✅';
const backupsGenerated = 'Your backup was generated in: \x1b[1m' + __dirname + '/backups/' + date + '.zip\x1b[0m - ✅';
const wpFy = '\x1b[42m\x1b[1mWordPressify\x1b[0m';
const wpFyUrl = '\x1b[2m - http://www.wordpressify.co/\x1b[0m';
const thankYou = 'Thank you for using ' + wpFy + wpFyUrl;

gulp.task('backup', () => {
	if (!fs.existsSync('./build')) {
		gutil.log(buildNotFound);
		process.exit(1);
	} else {
		gulp.src('build/wordpress/**')
			.pipe(zip(date + '.zip'))
			.pipe(gulp.dest('backups'))
			.on('end', () => {
				gutil.beep();
				gutil.log(backupsGenerated);
				gutil.log(thankYou);
			});
	}
});

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */
