import chalk from 'chalk';

const printNextSteps = () => {
	console.log('\n\n✅ ', chalk.black.bgGreen(' All done! Happy coding. \n'));
	console.log(
		'Installer has added 🎈 WordPressify files to the current directory.  ',
		'\nInside this directory, you can run this command:'
	);

	// Scripts
	console.log(
		'\n👉 ',
		' Type',
		chalk.black.bgWhite(' npm run dev '),
		'\n\n',
		'	Use to compile and run your files.',
		'\n',
		'	Watches for any changes and reports back any errors in your code.'
	);

	// Support
	console.log('\n✊ ', chalk.black.bgYellow(' Support WordPressify \n'));
	console.log(
		'Like WordPressify? Check out our other free and open source repositories: \n'
	);
	console.log(
		`	${chalk.yellow('Cherry → ')} https://bit.ly/3sEr75P`,
		'\n',
		`	${chalk.gray('• A design system to build the web.')}`,
		'\n',
		`	${chalk.yellow('GoPablo → ')} http://bit.ly/2Hgkfpy`,
		'\n',
		`	${chalk.gray('• Create optimized static websites.')}`,
		'\n',
		`	${chalk.yellow('WordPressify → ')} https://bit.ly/2KTqyQX`,
		'\n',
		`	${chalk.gray('• Automate your WordPress development workflow.')}`,
		'\n',
		`	${chalk.yellow('Nextify → ')} https://bit.ly/3m4lVWm`,
		'\n',
		`	${chalk.gray('• React apps using Next.js and Emotion.')}`,
		'\n',
		`	${chalk.yellow('FuzzyMail → ')} https://bit.ly/2P3Irlr`,
		'\n',
		`	${chalk.gray('• Responsive email template generator.')}`,
		'\n',
		`	${chalk.green('Powered by Riangle → ')} https://bit.ly/2P5i26I`,
		'\n',
		'\n',
		`	${chalk.red(
			'Thank you for using 🎈 WordPressify → '
		)} https://www.wordpressify.co`
	);

	// Get started
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
		` ${chalk.dim('2.')} Running: ${chalk.green('npm')} run start`,
		'\n\n'
	);
	process.exit();
};

export { printNextSteps };
