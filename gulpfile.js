const { gulp, series, parallel, dest, src, watch } = require('gulp');
const babel = require('gulp-babel');
const beeper = require('beeper');
const browserSync = require('browser-sync');
const concat = require('gulp-concat');
const connect = require('gulp-connect-php');
const del = require('del');
const log = require('fancy-log');
const fs = require('fs');
const imagemin = require('gulp-imagemin');
const inject = require('gulp-inject-string');
const partialimport = require('postcss-easy-import');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const postCSSMixins = require('postcss-mixins');
const postcssPresetEnv = require('postcss-preset-env');
const remoteSrc = require('gulp-remote-src');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const zip = require('gulp-vinyl-zip');

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */
const themeName = 'wordpressify';

/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
-------------------------------------------------------------------------------------------------- */
const pluginsListDev = [
	partialimport,
	postCSSMixins,
	postcssPresetEnv({
		stage: 0,
		features: {
			'nesting-rules': true,
			'color-mod-function': true,
			'custom-media': true,
		},
	}),
];

const pluginsListProd = [
	partialimport,
	postCSSMixins,
	postcssPresetEnv({
		stage: 0,
		features: {
			'nesting-rules': true,
			'color-mod-function': true,
			'custom-media': true,
		},
	}),
	require('cssnano')({
		preset: [
			'default',
			{
				discardComments: false,
			},
		],
	}),
];

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = ['./node_modules/jquery/dist/jquery.js'];

const footerJS = ['./src/assets/js/**'];

/* -------------------------------------------------------------------------------------------------
Installation Tasks
-------------------------------------------------------------------------------------------------- */
async function cleanup() {
	await del(['./build']);
	await del(['./dist']);
}

async function downloadWordPress() {
	await remoteSrc(['latest.zip'], {
		base: 'https://wordpress.org/',
	}).pipe(dest('./build/'));
}

async function unzipWordPress() {
	return await zip.src('./build/latest.zip').pipe(dest('./build/'));
}

async function copyConfig() {
	if (await fs.existsSync('./wp-config.php')) {
		return src('./wp-config.php')
			.pipe(inject.after("define( 'DB_COLLATE', '' );", "\ndefine( 'DISABLE_WP_CRON', true );"))
			.pipe(dest('./build/wordpress'));
	}
}

async function installationDone() {
	await beeper();
	await log(devServerReady);
	await log(thankYou);
}

exports.setup = series(cleanup, downloadWordPress);
exports.install = series(unzipWordPress, copyConfig, installationDone);

/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */
function devServer() {
	connect.server(
		{
			base: './build/wordpress',
			port: '3020',
		},
		() => {
			browserSync({
				logPrefix: '🎈 WordPressify',
				proxy: '127.0.0.1:3020',
				host: '127.0.0.1',
				port: '3010',
				open: 'external',
			});
		},
	);

	watch('./src/assets/css/**/*.css', stylesDev);
	watch('./src/assets/js/**', series(footerScriptsDev, Reload));
	watch('./src/assets/img/**', series(copyImagesDev, Reload));
	watch('./src/assets/fonts/**', series(copyFontsDev, Reload));
	watch('./src/theme/**', series(copyThemeDev, Reload));
	watch('./src/plugins/**', series(pluginsDev, Reload));
	watch('./build/wordpress/wp-config.php', { events: 'add' }, series(disableCron));
}

function Reload(done) {
	browserSync.reload();
	done();
}

function copyThemeDev() {
	if (!fs.existsSync('./build')) {
		log(buildNotFound);
		process.exit(1);
	} else {
		return src('./src/theme/**').pipe(dest('./build/wordpress/wp-content/themes/' + themeName));
	}
}

function copyImagesDev() {
	return src('./src/assets/img/**').pipe(
		dest('./build/wordpress/wp-content/themes/' + themeName + '/img'),
	);
}

function copyFontsDev() {
	return src('./src/assets/fonts/**').pipe(
		dest('./build/wordpress/wp-content/themes/' + themeName + '/fonts'),
	);
}

function stylesDev() {
	return src('./src/assets/css/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(postcss(pluginsListDev))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./build/wordpress/wp-content/themes/' + themeName))
		.pipe(browserSync.stream({ match: '**/*.css' }));
}

function headerScriptsDev() {
	return src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(concat('header-bundle.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./build/wordpress/wp-content/themes/' + themeName + '/js'));
}

function footerScriptsDev() {
	return src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sourcemaps.init())
		.pipe(
			babel({
				presets: ['@babel/preset-env'],
			}),
		)
		.pipe(concat('footer-bundle.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./build/wordpress/wp-content/themes/' + themeName + '/js'));
}

function pluginsDev() {
	return src(['./src/plugins/**', '!./src/plugins/README.md']).pipe(
		dest('./build/wordpress/wp-content/plugins'),
	);
}

exports.dev = series(
	copyThemeDev,
	copyImagesDev,
	copyFontsDev,
	stylesDev,
	headerScriptsDev,
	footerScriptsDev,
	pluginsDev,
	devServer,
);

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */
async function cleanProd() {
	await del(['./dist']);
}

function copyThemeProd() {
	return src(['./src/theme/**', '!./src/theme/**/node_modules/**']).pipe(
		dest('./dist/themes/' + themeName),
	);
}

function copyFontsProd() {
	return src('./src/assets/fonts/**').pipe(dest('./dist/themes/' + themeName + '/fonts'));
}

function stylesProd() {
	return src('./src/assets/css/style.css')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(postcss(pluginsListProd))
		.pipe(dest('./dist/themes/' + themeName));
}

function headerScriptsProd() {
	return src(headerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('header-bundle.js'))
		.pipe(uglify())
		.pipe(dest('./dist/themes/' + themeName + '/js'));
}

function footerScriptsProd() {
	return src(footerJS)
		.pipe(plumber({ errorHandler: onError }))
		.pipe(
			babel({
				presets: ['@babel/preset-env'],
			}),
		)
		.pipe(concat('footer-bundle.js'))
		.pipe(uglify())
		.pipe(dest('./dist/themes/' + themeName + '/js'));
}

function pluginsProd() {
	return src(['./src/plugins/**', '!./src/plugins/**/*.md']).pipe(dest('./dist/plugins'));
}

function processImages() {
	return src('./src/assets/img/**')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(
			imagemin([imagemin.svgo({ plugins: [{ removeViewBox: true }] })], {
				verbose: true,
			}),
		)
		.pipe(dest('./dist/themes/' + themeName + '/img'));
}

function zipProd() {
	return src('./dist/themes/' + themeName + '/**/*')
		.pipe(zip.dest('./dist/' + themeName + '.zip'))
		.on('end', () => {
			beeper();
			log(pluginsGenerated);
			log(filesGenerated);
			log(thankYou);
		});
}

exports.prod = series(
	cleanProd,
	copyThemeProd,
	copyFontsProd,
	stylesProd,
	headerScriptsProd,
	footerScriptsProd,
	pluginsProd,
	processImages,
	zipProd,
);

/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */
const onError = err => {
	beeper();
	log(wpFy + ' - ' + errorMsg + ' ' + err.toString());
	this.emit('end');
};

async function disableCron() {
	if (fs.existsSync('./build/wordpress/wp-config.php')) {
		await fs.readFile('./build/wordpress/wp-config.php', (err, data) => {
			if (err) {
				log(wpFy + ' - ' + warning + ' WP_CRON was not disabled!');
			}
			if (data) {
				if (data.indexOf('DISABLE_WP_CRON') >= 0) {
					log('WP_CRON is already disabled!');
				} else {
					return src('./build/wordpress/wp-config.php')
						.pipe(inject.after("define( 'DB_COLLATE', '' );", "\ndefine( 'DISABLE_WP_CRON', true );"))
						.pipe(dest('./build/wordpress'));
				}
			}
		});
	}
}

async function freshInstall() {
	await del(['./src/**']).then(() => {
		return src('./tools/fresh-theme/**').pipe(dest('./src'));
	});
}

exports.fresh = series(freshInstall);

function Backup() {
	if (!fs.existsSync('./build')) {
		log(buildNotFound);
		process.exit(1);
	} else {
		return src('./build/**/*')
			.pipe(zip.dest('./backups/' + date + '.zip'))
			.on('end', () => {
				beeper();
				log(backupsGenerated);
				log(thankYou);
			});
	}
}

exports.backup = series(Backup);

/* -------------------------------------------------------------------------------------------------
Messages
-------------------------------------------------------------------------------------------------- */
const date = new Date().toLocaleDateString('en-GB').replace(/\//g, '.');
const errorMsg = '\x1b[41mError\x1b[0m';
const warning = '\x1b[43mWarning\x1b[0m';
const devServerReady =
	'Your development server is ready, start the workflow with the command: $ \x1b[1mnpm run dev\x1b[0m';
const buildNotFound =
	errorMsg +
	' ⚠️　- You need to install WordPress first. Run the command: $ \x1b[1mnpm run install:wordpress\x1b[0m';
const filesGenerated =
	'Your ZIP template file was generated in: \x1b[1m' +
	__dirname +
	'/dist/' +
	themeName +
	'.zip\x1b[0m - ✅';
const pluginsGenerated =
	'Plugins are generated in: \x1b[1m' + __dirname + '/dist/plugins/\x1b[0m - ✅';
const backupsGenerated =
	'Your backup was generated in: \x1b[1m' + __dirname + '/backups/' + date + '.zip\x1b[0m - ✅';
const wpFy = '\x1b[42m\x1b[1mWordPressify\x1b[0m';
const wpFyUrl = '\x1b[2m - http://www.wordpressify.co/\x1b[0m';
const thankYou = 'Thank you for using ' + wpFy + wpFyUrl;

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */
