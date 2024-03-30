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

	let upstreamUrl = `https://raw.githubusercontent.com/luangjokaj/wordpressify/v${version}`;

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

		`${upstreamUrl}/src/assets/css/parts/footer.css`,
		`${upstreamUrl}/src/assets/css/parts/header.css`,

		`${upstreamUrl}/src/assets/css/patterns/sample.css`,

		`${upstreamUrl}/src/assets/css/style.css`,
		`${upstreamUrl}/src/assets/css/wordpressify.css`,

		`${upstreamUrl}/src/assets/fonts/inter/Inter-VariableFont_slnt,wght.woff2`,
		`${upstreamUrl}/src/assets/fonts/inter/LICENSE.txt`,

		`${upstreamUrl}/src/assets/img/logo.svg`,

		`${upstreamUrl}/src/assets/js/main.js`,

		`${upstreamUrl}/src/theme/parts/footer.html`,
		`${upstreamUrl}/src/theme/parts/header.html`,

		`${upstreamUrl}/src/theme/patterns/footer.php`,
		`${upstreamUrl}/src/theme/patterns/header.php`,
		`${upstreamUrl}/src/theme/patterns/sample.php`,

		`${upstreamUrl}/src/theme/templates/404.html`,
		`${upstreamUrl}/src/theme/templates/archive.html`,
		`${upstreamUrl}/src/theme/templates/blank.html`,
		`${upstreamUrl}/src/theme/templates/home.html`,
		`${upstreamUrl}/src/theme/templates/index.html`,
		`${upstreamUrl}/src/theme/templates/page-no-title-full-width.html`,
		`${upstreamUrl}/src/theme/templates/page-no-title.html`,
		`${upstreamUrl}/src/theme/templates/page.html`,
		`${upstreamUrl}/src/theme/templates/search.html`,
		`${upstreamUrl}/src/theme/templates/single.html`,

		`${upstreamUrl}/src/theme/functions.php`,
		`${upstreamUrl}/src/theme/index.php`,
		`${upstreamUrl}/src/theme/screenshot.png`,
		`${upstreamUrl}/src/theme/theme.json`,

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
	const cssPartsFiles = ['footer.css', 'header.css'];
	const cssPatternsFiles = ['sample.css'];
	const fontFiles = ['Inter-VariableFont_slnt,wght.woff2', 'LICENSE.txt'];
	const imgFiles = ['logo.svg'];
	const jsFiles = ['main.js'];
	const themeFiles = [
		'functions.php',
		'index.php',
		'screenshot.png',
		'theme.json',
	];
	const partsFiles = ['footer.html', 'header.html'];
	const patternsFiles = ['footer.php', 'header.php', 'sample.php'];
	const templatesFiles = [
		'404.html',
		'archive.html',
		'blank.html',
		'home.html',
		'index.html',
		'page-no-title-full-width.html',
		'page-no-title.html',
		'page.html',
		'search.html',
		'single.html',
	];

	const configFiles = ['php.ini'];
	const nginxFiles = ['nginx.conf'];

	// Start
	console.log('\n');
	console.log(
		'📦 ',
		chalk.black.bgYellow(
			` Downloading 🎈 WordPressify files in: → ${chalk.bgGreen(` ${theDir} `)}\n`,
		),
		chalk.dim(`\n In the directory: ${theCWD}\n`),
		chalk.dim('This might take a couple of minutes.\n'),
	);

	const spinner = ora({ text: '' });
	spinner.start(
		`1. Creating 🎈 WordPressify files inside → ${chalk.black.bgWhite(
			` ${theDir} `,
		)}`,
	);

	// Download
	Promise.all(filesToDownload.map((x) => download(x, `${theCWD}`))).then(
		async () => {
			if (!fs.existsSync('src')) {
				await execa('mkdir', [
					'config',
					'config/nginx',
					'src',
					'src/assets',
					'src/assets/css',
					'src/assets/css/parts',
					'src/assets/css/patterns',
					'src/assets/fonts',
					'src/assets/fonts/inter',
					'src/assets/img',
					'src/assets/js',
					'src/plugins',
					'src/theme',
					'src/theme/parts',
					'src/theme/patterns',
					'src/theme/templates',
				]);
			}

			dotFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x.slice(1)}`, `${theCWD}/${x}`, (err) =>
					handleError(err),
				),
			);
			cssFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/css/${x}`, (err) =>
					handleError(err),
				),
			);
			cssPartsFiles.map((x) =>
				fs.renameSync(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/css/parts/${x}`,
					(err) => handleError(err),
				),
			);
			cssPatternsFiles.map((x) =>
				fs.renameSync(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/css/patterns/${x}`,
					(err) => handleError(err),
				),
			);
			fontFiles.map((x) =>
				fs.renameSync(
					`${theCWD}/${x}`,
					`${theCWD}/src/assets/fonts/inter/${x}`,
					(err) => handleError(err),
				),
			);
			imgFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/img/${x}`, (err) =>
					handleError(err),
				),
			);
			jsFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/js/${x}`, (err) =>
					handleError(err),
				),
			);
			themeFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/${x}`, (err) =>
					handleError(err),
				),
			);
			partsFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/parts/${x}`, (err) =>
					handleError(err),
				),
			);
			patternsFiles.map((x) =>
				fs.renameSync(
					`${theCWD}/${x}`,
					`${theCWD}/src/theme/patterns/${x}`,
					(err) => handleError(err),
				),
			);
			templatesFiles.map((x) =>
				fs.renameSync(
					`${theCWD}/${x}`,
					`${theCWD}/src/theme/templates/${x}`,
					(err) => handleError(err),
				),
			);
			configFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/config/${x}`, (err) =>
					handleError(err),
				),
			);
			nginxFiles.map((x) =>
				fs.renameSync(`${theCWD}/${x}`, `${theCWD}/config/nginx/${x}`, (err) =>
					handleError(err),
				),
			);
			spinner.succeed();

			spinner.start('2. WordPressify is ready to go ⚡');
			spinner.succeed();

			// Done
			printNextSteps();
		},
	);
};

export { run };
