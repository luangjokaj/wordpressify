/**
 * Prints next steps.
 *
 * @param {string} blockName The block name.
 * @param  {string} blockDir The block directory.
 */

const chalk = require('chalk');

module.exports = () => {
	console.log('\n\n✅ ', chalk.black.bgGreen(' All done! Happy coding. \n'));
	console.log(
		'Installer has added 🎈 WordPressify files to the current directory.  ',
		'\nInside this directory, you can run this command:'
	);

	// Scripts.
	console.log(
		'\n👉 ',
		' Type',
		chalk.black.bgWhite(' npm run dev '),
		'\n\n',
		'	Use to compile and run your files.',
		'\n',
		'	Watches for any changes and reports back any errors in your code.'
	);

	// Support.
	console.log('\n✊ ', chalk.black.bgYellow(' Support WordPressify \n'));
	console.log(
		'Like WordPressify? Check out our other free and open source repositories: \n'
	);
	console.log(
		`	${chalk.yellow('GoPablo →')} https://bit.ly/2Hgkfpy`,
		'\n',
		`	${chalk.gray('GoPablo is a static site generator.')}`,
		'\n',
		`	${chalk.yellow('FuzzyMail →')} https://bit.ly/2P3Irlr`,
		'\n',
		`	${chalk.gray('Email template generator. Making emails fun again.')}`,
		'\n',
		`	${chalk.yellow('ReactFondue →')} https://bit.ly/2OXgStR`,
		'\n',
		`	${chalk.gray('SEO optimized React applications with SSR.')}`,
		'\n',
		`	${chalk.green('Powered by Riangle →')} https://bit.ly/2P5i26I`,
		'\n',
		'\n',
		`	${chalk.red(
			'Thank you for using 🎈 WordPressify →'
		)} https://www.wordpressify.co`
	);

	// Get started.
	console.log('\n\n🎯 ', chalk.black.bgGreen(' Get Started → \n'));
	console.log(' You can start: \n');
	console.log(
		` ${chalk.dim('1.')} Editing the configuration: ${chalk.green(
			`${process.cwd()}/gulpfile.js`
		)}`
	);
	console.log(
		`	${chalk.dim('Set your new theme name:')} ${chalk.green(
			'const themeName = "'
		)}${chalk.red('wordpressify')}${chalk.green('";')} `
	);
	console.log(
		` ${chalk.dim('2.')} Running: ${chalk.green('npm')} run dev`,
		'\n\n'
	);
	process.exit();
};
