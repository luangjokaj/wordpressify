import fs from 'fs';
import ora from 'ora';
import chalk from 'chalk';
import download from 'download';
import { execa } from 'execa';
import { createRequire } from 'module';
import { handleError } from './handleError.js';
import { clearConsole } from './clearConsole.js';
import { printNextSteps } from './printNextSteps.js';

const require = createRequire(import.meta.url);
const packageData = require('../package.json');

const version = packageData.version;

const theCWD = process.cwd();
const theCWDArray = theCWD.split('/');
const theDir = theCWDArray[theCWDArray.length - 1];

const run = () => {
	// Init
	clearConsole();

	let upstreamUrl = `https://raw.githubusercontent.com/luangjokaj/wordpressify/mountainash-master`;

	// Files
	const filesToDownload = [
		`${upstreamUrl}/.babelrc`,
		`${upstreamUrl}/.dockerignore`,
		`${upstreamUrl}/.editorconfig`,
		`${upstreamUrl}/.env_example`,
		`${upstreamUrl}/.gitignore`,
		`${upstreamUrl}/.stylelintrc`,
		`${upstreamUrl}/docker-compose.yml`,
		`${upstreamUrl}/Dockerfile-nodejs`,
		`${upstreamUrl}/Dockerfile-wordpress`,
		`${upstreamUrl}/gulpfile.js`,
		`${upstreamUrl}/LICENSE`,
		`${upstreamUrl}/README.md`,
		`${upstreamUrl}/installer/package.json`,
		`${upstreamUrl}/installer/package-lock.json`,

		`${upstreamUrl}/src/assets/css/style.css`,
		`${upstreamUrl}/src/assets/css/wordpressify.css`,

		`${upstreamUrl}/src/assets/js/main.js`,

		`${upstreamUrl}/src/assets/img/logo.svg`,

		`${upstreamUrl}/src/theme/404.php`,
		`${upstreamUrl}/src/theme/archive.php`,
		`${upstreamUrl}/src/theme/comments.php`,
		`${upstreamUrl}/src/theme/content-none.php`,
		`${upstreamUrl}/src/theme/content-page.php`,
		`${upstreamUrl}/src/theme/content-single.php`,
		`${upstreamUrl}/src/theme/content.php`,
		`${upstreamUrl}/src/theme/footer.php`,
		`${upstreamUrl}/src/theme/functions.php`,
		`${upstreamUrl}/src/theme/header.php`,
		`${upstreamUrl}/src/theme/index.php`,
		`${upstreamUrl}/src/theme/page.php`,
		`${upstreamUrl}/src/theme/screenshot.png`,
		`${upstreamUrl}/src/theme/search.php`,
		`${upstreamUrl}/src/theme/searchform.php`,
		`${upstreamUrl}/src/theme/sidebar.php`,
		`${upstreamUrl}/src/theme/single.php`,

		`${upstreamUrl}/config/php.ini`,
		`${upstreamUrl}/config/nginx/nginx.conf`,
	];

	// Organise file structure
	const dotFiles = [
		'.babelrc',
		'.dockerignore',
		'.editorconfig',
		'.env_example',
		'.gitignore',
		'.stylelintrc',
	];
	const cssFiles = ['style.css', 'wordpressify.css'];
	const jsFiles = ['main.js'];
	const imgFiles = ['logo.svg'];
	const themeFiles = [
		'404.php',
		'archive.php',
		'comments.php',
		'content-none.php',
		'content-page.php',
		'content-single.php',
		'content.php',
		'footer.php',
		'functions.php',
		'header.php',
		'index.php',
		'page.php',
		'screenshot.png',
		'search.php',
		'searchform.php',
		'sidebar.php',
		'single.php',
	];
	const configFiles = ['php.ini'];
	const nginxFiles = [
		'nginx.conf',
	];

	// Start
	console.log('\n');
	console.log(
		'📦 ',
		chalk.black.bgYellow(
			` Downloading 🎈 WordPressify files in: → ${chalk.bgGreen(
				` ${theDir} `
			)}\n`
		),
		chalk.dim(`\n In the directory: ${theCWD}\n`),
		chalk.dim('This might take a couple of minutes.\n')
	);

	const spinner = ora({ text: '' });
	spinner.start(
		`1. Creating 🎈 WordPressify files inside → ${chalk.black.bgWhite(
			` ${theDir} `
		)}`
	);

	// Download
	Promise.all(filesToDownload.map((x) => download(x, `${theCWD}`))).then(
		async () => {
			if (!fs.existsSync('src')) {
				await execa('mkdir', [
					'src',
					'src/theme',
					'src/plugins',
					'src/assets',
					'src/assets/css',
					'src/assets/js',
					'src/assets/img',
					'config',
					'config/nginx',
				]);
			}

			dotFiles.map((x) =>
				fs.rename(`${theCWD}/${x.slice(1)}`, `${theCWD}/${x}`, (err) =>
					handleError(err)
				)
			);
			cssFiles.map((x) =>
				fs.rename(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/css/${x}`,
					(err) => handleError(err)
				)
			);
			jsFiles.map((x) =>
				fs.rename(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/js/${x}`,
					(err) => handleError(err)
				)
			);
			imgFiles.map((x) =>
				fs.rename(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/img/${x}`,
					(err) => handleError(err)
				)
			);
			themeFiles.map((x) =>
				fs.rename(`${theCWD}/${x}`, `${theCWD}/src/theme/${x}`, (err) =>
					handleError(err)
				)
			);
			configFiles.map((x) =>
				fs.rename(`${theCWD}/${x}`, `${theCWD}/config/${x}`, (err) =>
					handleError(err)
				)
			);
			nginxFiles.map((x) =>
				fs.rename(
					`${theCWD}/${x}`,
					`${theCWD}/config/nginx/${x}`,
					(err) => handleError(err)
				)
			);
			spinner.succeed();

			spinner.start('2. WordPressify is ready to go ⚡');
			spinner.succeed();

			// Done
			printNextSteps();
		}
	);
};

export { run };
