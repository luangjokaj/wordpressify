const { gulp, series, parallel, dest, src, watch } = require( 'gulp' );
const babel = require( 'gulp-babel' );
const beeper = require( 'beeper' );
const browserSync = require( 'browser-sync' );
const concat = require( 'gulp-concat' );
const del = require( 'del' );
const log = require( 'fancy-log' );
const fs = require( 'fs' );
const imagemin = require( 'gulp-imagemin' );
const partialimport = require( 'postcss-easy-import' );
const plumber = require( 'gulp-plumber' );
const postcss = require( 'gulp-postcss' );
const postCSSMixins = require( 'postcss-mixins' );
const autoprefixer = require( 'autoprefixer' );
const postcssPresetEnv = require( 'postcss-preset-env' );
const sourcemaps = require( 'gulp-sourcemaps' );
const uglify = require( 'gulp-uglify' );
const zip = require( 'gulp-vinyl-zip' );
const dotenv = require( 'dotenv' );
const path = require( 'path' );
const { execSync } = require( 'child_process' );

dotenv.config();
let envStart = series( setupEnvironment, startContainers );

// gulp done function for devServer so that the completion can be
// signaled from event handlers
let devServerDone;

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */
const themeName = 'wordpressify';

/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
-------------------------------------------------------------------------------------------------- */
const pluginsListDev = [
	partialimport,
	postcssPresetEnv( {
		stage: 0,
		features: {
			'nesting-rules': true,
			'color-mod-function': true,
			'custom-media': true,
		},
	} ),
	postCSSMixins,
	autoprefixer,
];

const pluginsListProd = [
	partialimport,
	postcssPresetEnv( {
		stage: 0,
		features: {
			'nesting-rules': true,
			'color-mod-function': true,
			'custom-media': true,
		},
	} ),
	postCSSMixins,
	autoprefixer,
	require( 'cssnano' )( {
		preset: [
			'default',
			{
				discardComments: false,
			},
		],
	} ),
];

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = [ './node_modules/jquery/dist/jquery.js' ];

const footerJS = [ './src/assets/js/**' ];

/* -------------------------------------------------------------------------------------------------
Environment Tasks
-------------------------------------------------------------------------------------------------- */
function setupEnvironment( done ) {
	if ( ! fs.existsSync( './build' ) ) {
		fs.mkdirSync( './build' );
		fs.mkdirSync( './build/wordpress' );
	}
	if ( ! fs.existsSync( './xdebug' ) ) {
		fs.mkdirSync( './xdebug' );
	}
	if ( ! fs.existsSync( './Dockerfile' ) ) {
		let contents = fs.readFileSync( './Dockerfile.in', {
			encoding: 'utf8',
		} );
		contents = contents.replace( /\{\{UID\}\}/g, process.getuid() );
		contents = contents.replace( /\{\{GID\}\}/g, process.getgid() );
		fs.writeFileSync( './Dockerfile', contents );
	}
	if ( ! fs.existsSync( './config/php.ini' ) ) {
		let contents = fs.readFileSync( './config/php.ini.in', {
			encoding: 'utf8',
		} );
		// If you're on Linux, you might have to modify the IP address 172.29.0.1 - See README
		let replacement =
			process.platform === 'win32' || process.platform === 'darwin'
				? 'host.docker.internal'
				: '172.29.0.1';
		contents = contents.replace(
			/\{\{XDEBUG_CLIENT_HOST\}\}/g,
			replacement
		);
		fs.writeFileSync( './config/php.ini', contents );
	}
	if ( ! fs.existsSync( './.env' ) ) {
		let contents = fs.readFileSync( './.env.in', { encoding: 'utf8' } );
		contents = contents.replace( /\{\{WPFY_UID\}\}/g, process.getuid() );
		contents = contents.replace( /\{\{WPFY_GID\}\}/g, process.getgid() );
		fs.writeFileSync( './.env', contents );
	}
	done();
}

function startContainers( done ) {
	execSync( 'docker-compose up -d', { stdio: 'inherit' } );
	done();
}

function registerCleanup( done ) {
	process.on( 'exit', stopContainers );
	process.on( 'SIGINT', () => {
		if ( typeof devServerDone === 'function' ) {
			devServerDone();
		}
		process.exit( 0 );
	} );
	done();
}

function buildContainers( done ) {
	execSync( 'docker-compose up --build --no-start', { stdio: 'inherit' } );
	done();
}

function stopContainers( done ) {
	execSync( 'docker-compose down', { stdio: 'inherit' } );
	if ( typeof done === 'function' ) {
		done();
	}
}

async function cleanEnvironment( done ) {
	execSync( 'docker-compose down', { stdio: 'inherit' } );
	await del( [ 'build', 'Dockerfile', 'xdebug', 'config/php.ini', '.env' ] );
	done();
}

function rebuildContainers( done ) {
	execSync( 'docker-compose up -d --build --force-recreate', {
		stdio: 'inherit',
	} );
	done();
}

function restartWordPress( done ) {
	execSync( 'docker-compose restart wordpress' );
	done();
}

exports[ 'env:build' ] = series( setupEnvironment, buildContainers );
exports[ 'env:start' ] = envStart;
exports[ 'env:stop' ] = stopContainers;
exports[ 'env:rebuild' ] = series(
	cleanEnvironment,
	setupEnvironment,
	rebuildContainers
);
exports[ 'env:restart' ] = restartWordPress;

/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */
function devServer( done ) {
	devServerDone = done;
	browserSync( {
		logPrefix: '🎈 WordPressify',
		proxy: `127.0.0.1:${ process.env.SERVER_PORT }`,
		host: '127.0.0.1',
		port: `${ process.env.PROXY_PORT }`,
		open: 'local',
	} );

	watch( './src/assets/css/**/*.css', stylesDev );
	watch( './src/assets/js/**', series( footerScriptsDev, Reload ) );
	watch( './src/assets/img/**', series( copyImagesDev, Reload ) );
	watch( './src/assets/fonts/**', series( copyFontsDev, Reload ) );
	watch( './src/theme/**', series( copyThemeDev, stylesDev, Reload ) );
	watch( './src/plugins/**', series( pluginsDev, Reload ) );
}

function Reload( done ) {
	browserSync.reload();
	done();
}

function copyWelcomeIndex() {
	return src( './config/nginx/welcome.html' ).pipe(
		dest( './build/wordpress' )
	);
}

function copyThemeDev() {
	if ( ! fs.existsSync( './build' ) ) {
		log( buildNotFound );
		process.exit( 1 );
	} else {
		return src( './src/theme/**' ).pipe(
			dest( './build/wordpress/wp-content/themes/' + themeName )
		);
	}
}

function copyImagesDev() {
	return src( './src/assets/img/**' ).pipe(
		dest( './build/wordpress/wp-content/themes/' + themeName + '/img' )
	);
}

function copyFontsDev() {
	return src( './src/assets/fonts/**' ).pipe(
		dest( './build/wordpress/wp-content/themes/' + themeName + '/fonts' )
	);
}

function stylesDev() {
	return src( './src/assets/css/style.css' )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe( sourcemaps.init() )
		.pipe( postcss( pluginsListDev ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( dest( './build/wordpress/wp-content/themes/' + themeName ) )
		.pipe( browserSync.stream( { match: '**/*.css' } ) );
}

function headerScriptsDev() {
	return src( headerJS )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'header-bundle.js' ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(
			dest( './build/wordpress/wp-content/themes/' + themeName + '/js' )
		);
}

function footerScriptsDev() {
	return src( footerJS )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe( sourcemaps.init() )
		.pipe(
			babel( {
				presets: [ '@babel/preset-env' ],
			} )
		)
		.pipe( concat( 'footer-bundle.js' ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe(
			dest( './build/wordpress/wp-content/themes/' + themeName + '/js' )
		);
}

function pluginsDev() {
	return src( [ './src/plugins/**', '!./src/plugins/README.md' ] ).pipe(
		dest( './build/wordpress/wp-content/plugins' )
	);
}

exports.dev = series(
	envStart,
	registerCleanup,
	copyWelcomeIndex,
	copyThemeDev,
	copyImagesDev,
	copyFontsDev,
	stylesDev,
	headerScriptsDev,
	footerScriptsDev,
	pluginsDev,
	devServer
);

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */
async function cleanProd() {
	await del( [ './dist' ] );
}

function copyThemeProd() {
	return src( [ './src/theme/**', '!./src/theme/**/node_modules/**' ] ).pipe(
		dest( './dist/themes/' + themeName )
	);
}

function copyFontsProd() {
	return src( './src/assets/fonts/**' ).pipe(
		dest( './dist/themes/' + themeName + '/fonts' )
	);
}

function stylesProd() {
	return src( './src/assets/css/style.css' )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe( postcss( pluginsListProd ) )
		.pipe( dest( './dist/themes/' + themeName ) );
}

function headerScriptsProd() {
	return src( headerJS )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe( concat( 'header-bundle.js' ) )
		.pipe( uglify() )
		.pipe( dest( './dist/themes/' + themeName + '/js' ) );
}

function footerScriptsProd() {
	return src( footerJS )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe(
			babel( {
				presets: [ '@babel/preset-env' ],
			} )
		)
		.pipe( concat( 'footer-bundle.js' ) )
		.pipe( uglify() )
		.pipe( dest( './dist/themes/' + themeName + '/js' ) );
}

function pluginsProd() {
	return src( [ './src/plugins/**', '!./src/plugins/**/*.md' ] ).pipe(
		dest( './dist/plugins' )
	);
}

function processImages() {
	return src( './src/assets/img/**' )
		.pipe( plumber( { errorHandler: onError } ) )
		.pipe(
			imagemin(
				[ imagemin.svgo( { plugins: [ { removeViewBox: true } ] } ) ],
				{
					verbose: true,
				}
			)
		)
		.pipe( dest( './dist/themes/' + themeName + '/img' ) );
}

function zipProd() {
	return src( './dist/themes/' + themeName + '/**/*' )
		.pipe( zip.dest( './dist/' + themeName + '.zip' ) )
		.on( 'end', () => {
			beeper();
			log( pluginsGenerated );
			log( filesGenerated );
			log( thankYou );
		} );
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
	zipProd
);

/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */
const onError = ( err ) => {
	beeper();
	log( wpFy + ' - ' + errorMsg + ' ' + err.toString() );
	this.emit( 'end' );
};

function Backup() {
	if ( ! fs.existsSync( './build' ) ) {
		log( buildNotFound );
		process.exit( 1 );
	} else {
		return src( './build/**/*' )
			.pipe( zip.dest( './backups/' + date + '.zip' ) )
			.on( 'end', () => {
				beeper();
				log( backupsGenerated );
				log( thankYou );
			} );
	}
}

exports.backup = Backup;

/* -------------------------------------------------------------------------------------------------
Messages
-------------------------------------------------------------------------------------------------- */
const date = new Date().toLocaleDateString( 'en-GB' ).replace( /\//g, '.' );
const errorMsg = '\x1b[41mError\x1b[0m';
const warning = '\x1b[43mWarning\x1b[0m';
const devServerReady =
	'Your development server is ready, start the workflow with the command: $ \x1b[1mnpm run dev\x1b[0m';
const buildNotFound =
	errorMsg +
	' ⚠️　- You need to build the project first. Run the command: $ \x1b[1mnpm run env:start\x1b[0m';
const filesGenerated =
	'Your ZIP template file was generated in: \x1b[1m' +
	__dirname +
	'/dist/' +
	themeName +
	'.zip\x1b[0m - ✅';
const pluginsGenerated =
	'Plugins are generated in: \x1b[1m' +
	__dirname +
	'/dist/plugins/\x1b[0m - ✅';
const backupsGenerated =
	'Your backup was generated in: \x1b[1m' +
	__dirname +
	'/backups/' +
	date +
	'.zip\x1b[0m - ✅';
const wpFy = '\x1b[42m\x1b[1mWordPressify\x1b[0m';
const wpFyUrl = '\x1b[2m - https://www.wordpressify.co/\x1b[0m';
const thankYou = 'Thank you for using ' + wpFy + wpFyUrl;

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */
