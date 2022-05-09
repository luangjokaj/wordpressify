import prompts from 'prompts';
import chalk from 'chalk';
import { program } from 'commander';
import { createRequire } from 'module';
import { run } from './modules/run.js';

const require = createRequire(import.meta.url);
const packageData = require('./package.json');

const version = packageData.version;
const currentNodeVersion = process.versions.node;
const semver = currentNodeVersion.split('.');
const major = semver[0];

program
	.version(version, '-v, --vers', 'output the current version')
	.option('-y, --non-interactive', 'do not prompt for user input')
	.parse(process.argv);

(async () => {
	let response = {};
	if (!program.nonInteractive) {
		response = await prompts({
			type: 'confirm',
			name: 'value',
			message: `Do you want to install ${chalk.white.bgGreen(
				'🎈 WordPressify'
			)} in the current directory?\n${chalk.red(process.cwd())}`,
		});
	}

	if (program.nonInteractive || response.value) {
		// If below Node 12
		if (12 > major) {
			console.error(
				chalk.red(
					'You are running Node ' +
						currentNodeVersion +
						'.\n' +
						'Install WordPressify requires Node 12 or higher. \n' +
						'Kindly, update your version of Node.'
				)
			);
			process.exit(1);
		}

		// Makes the script crash on unhandled rejections instead of silently
		// ignoring them. In the future, promise rejections that are not handled will
		// terminate the Node.js process with a non-zero exit code
		process.on('unhandledRejection', (err) => {
			throw err;
		});

		/**
		 * Run the entire program
		 *
		 * Runs all the functions with async/await
		 */
		run();
	}
})();
