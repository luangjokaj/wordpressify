[![WordPressify Logo](https://i.imgur.com/5dVJS70.png)](http://www.wordpressify.co/)

[![Dependencies](https://david-dm.org/luangjokaj/wordpressify/status.svg)](https://david-dm.org/luangjokaj/wordpressify)

A build system designed to automate your WordPress development workflow.

http://www.wordpressify.co/

- [Introduction](#introduction)
	- [Features](#features)
- [1. Installing Node](#1-installing-node)
- [2. Set Up Project](#2-set-up-project)
	- [Install WordPressify from NPM](#install-wordpressify-from-npm)
	- [Install WordPressify from Repository](#install-wordpressify-from-repository)
- [3. CSS, PostCSS and Sass](#3-css-postcss-and-sass)
	- [PostCSS](#postcss)
	- [Sass](#sass)
- [4. Images and Fonts](#4-images-and-fonts)
	- [Images](#images)
	- [Fonts](#fonts)
- [5. JavaScript ES6](#5-javascript-es6)
	- [Write ES6 JavaScript](#write-es6-javascript)
- [6. External Libraries](#6-external-libraries)
- [7. Build Backups](#7-build-backups)
- [8. Code Style Rules](#8-code-style-rules)
	- [Lint CSS](#lint-css)
- [9. Database](#9-database)
	- [MySQL/MariaDB Server](#mysqlmariadb-server)
	- [Remote Database](#remote-database)
- [10. Deployment](#10-deployment)
	- [Automated Deployments](#automated-deployments)
- [11. Cleanup Default Theme](#11-cleanup-default-theme)
- [12. Windows Installation](#12-windows-installation)
- [Changelog](#changelog)
- [License](#license)

## Introduction
WordPressify is a modern workflow for your WordPress development, with an integrated web server and auto-reload. CSS preprocessors and ES6 ready.

## Features
|👇|Includes|
|:-:|:---|
|📦| Dev Server|
|🔥| Hot Reload & CSS Injection|
|🎨| PostCSS & Next Generation CSS|
|⚙| Babel 7 - ES6 JavaScript|
|✂️| Source Maps|
|🎒| Code Minification|
|🌈| Image Compression|
|🤖| External Libraries|
|🛎| Production ready ZIP theme|

WordPressify comes with a development server for PHP running under a proxy with BrowserSync. Watches for all your changes and reloads the webpage in real-time. Style are preprocessors with PostCSS or Sass. Babel compiler for writing next-generation JavaScript. Source maps are supported for both CSS and JavaScript. WordPressify allows easy import of external JavaScript libraries and npm scripts, it has a flexible build and can be easily customized with gulp tasks.

# 1. Installing Node
WordPressify requires Node v7.5+. This is the only global dependency. You can download Node **[here](https://nodejs.org/)**.

Node.js is a JavaScript runtime built on Chrome’s V8 JavaScript engine. Node.js uses an event-driven, non-blocking I/O model that makes it lightweight and efficient. Node.js’ package ecosystem, npm, is the largest ecosystem of open source libraries in the world.

# 2. Set Up Project
## File Structure
```
    ├── build/                   # Build files
    ├── dist/                    # Distribution files
    ├── src/                     # Source files
    │   ├── assets/              # Assets directory
    │       ├── css/             # CSS files
    │       ├── fonts/           # Fonts directory
    │       ├── img/             # Image directory
    │       ├── js/              # JavaScript files
    │   ├── plugins/             # WordPress plugins
    │   ├── theme/               # PHP Template files
    └── .babelrc                 # Babel configuration
    └── .gitignore               # Git ignored files
    └── .stylelintrc             # Stylelint configuration file
    └── gulpfile.js              # Gulp configuration
    └── LICENSE                  # License agreements
    └── package-lock.json        # Packages lock file
    └── package.json             # Node packages
    └── README.md                # You are reading this
```

## Install WordPressify from NPM
To install WordPressify from NPM, run the command:
```
sudo npm i wordpressify -g
```

**START WORDPRESSIFY**

- Create a directory for the new WordPress website and from there run WordPressify to generate the file structure:
```
wordpressify
```

## Install WordPressify from Repository
To install WordPressify you need to clone the repository from GitHub:
```
git clone https://github.com/luangjokaj/wordpressify
```
- This will clone the repository on your local machine. Navigate to the newly created folder.

- Replace the file: `./package.json` with `./installer/package.json` and continue with the dependency installation.

**INSTALL DEPENDENCIES**

```
npm install
```

**CHANGE TEMPLATE NAME**

- At this point WordPressify is installed and ready to be used for the first time. Before starting, open **gulpfile.js** and edit your template name:
```javascript
/* -------------------------------------------------------------------------------------------------
Theme Name
 ------------------------------------------------------------------------------------------------- */
const themeName = 'wordpressify';
//--------------------------------------------------------------------------------------------------
```

**INSTALL WORDPRESS**

- On the first run we need to install WordPress, we do this once by running the command:
```
npm run install:wordpress
```

- It will fetch the latest WordPress version, which is the build we use for the development server.

**START WORKFLOW**

- We are ready to start our development server with the command:
```
npm run dev
```

- If you are running a fresh instance of WordPress, the installation wizard will set up a **wp-config.php** file containing database credentials, site name etc.
- You are ready to go! Happy coding!

**WORDPRESS PLUGINS**

- If you want to add or build WordPress plugins, you can do that from the directory:
```
src/plugins/
```

**PRODUCTION TEMPLATE**

- To generate your distribution files run the command:
```
npm run prod
```

- The template will be saved as a zip file in:
```
dist/wordpressify.zip
```

**WINDOWS USERS**
- If you are running Windows, PHP has to be installed and configured. Check the [gulp-connect-php](https://www.npmjs.com/package/gulp-connect-php) documentation. 

We prepared a video screencast **demonstrating the installation processs using a Windows** operating system, you can find it here: [How to install WordPressify on Windows?](https://www.wordpressify.co/windows-installation/)
Or check out this tutorial on [Medium](https://medium.com/@marcus.supernova/how-to-install-wordpressify-on-windows-4b78a801165b).

# 3. CSS, PostCSS and Sass
## PostCSS
By default WordPressify supports [PostCSS](http://postcss.org/), a similar preprocessor to Sass, Less and others but with more functionality. On top of that PostCSS is 3x faster than Sass and 4x faster than Less. Features come in the shape of PostCSS plugins. Think of these like using Lego, where each piece is a different feature that can transform your CSS in some way. PostCSS lets you stick these pieces together so that you can build up your own feature set, adding and removing plugins as and when you need them. [postcss-preset-env](https://preset-env.cssdb.org//) is installed by default. Read more about PostCSS [here](https://ashleynolan.co.uk/blog/postcss-a-review).

**POSTCSS PLUGINS**

WordPressify has two different sets of PostCSS plugins - one for the development environment (pluginsListDev) and one for the production task (pluginsListProd).
```javascript
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
 ------------------------------------------------------------------------------------------------- */
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
		preset: ['default', {
			discardComments: false,
		}]
	}),
];
//--------------------------------------------------------------------------------------------------
```

**WRITING CSS**

The starting point for CSS is the file:
```
src/assets/css/style.css
```

The template definitions are located here too. It is also where all other imports are included in the stylesheets.
```
/*
Theme Name: WordPressify
Theme URI: https://www.wordpressify.co
Author: Luan Gjokaj
Author URI: https://www.riangle.com
Description: WordPressify official theme.
Version: 1.0
Tags: responsive, clean, minimal, modern, documentation
*/
```

## Sass
WordPressify is super flexible. You can install Sass and use it as the main CSS preprocessor:
```
npm install gulp-sass --save-dev
````

Include Sass in gulpfile.js:
```javascript
const sass = require('gulp-sass');
````

Change the gulp tasks stylesDev to:
```javascript
function stylesDev() {
	return src('./src/assets/css/style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on("error", sass.logError))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./build/wordpress/wp-content/themes/' + themeName))
		.pipe(browserSync.stream({ match: '**/*.css' }));
}
```

Also the watch task has to be changed in order to watch for .scss filetypes:
```javascript
watch('./src/assets/css/**/*.scss', stylesDev);
```

Change the gulp tasks styleProd to:
```javascript
function stylesProd() {
	return src('./src/assets/css/style.scss')
		.pipe(sass().on("error", sass.logError))
		.pipe(dest('./dist/themes/' + themeName));
}
```

# 4. Images and Fonts
## Images
It is recommended to store template image assets in your theme directory:
```
src/assets/img/
```

Ideally other images should be managed through the [Media Library](https://codex.wordpress.org/Media_Library_Screen) of WordPress. Try to only store SVG or minimal assets in your theme directory to keep the template as light as possible.

In the production build SVGs and other image assets will go through a **minification** process.

## Fonts
Fonts are always special. Your fonts should be stored in:
```
src/assets/fonts/
```

Then you can include them in your **CSS**:
```css
@font-face {
	font-family: 'Helvetica Neue Thin';
	src: url('./fonts/Helvetica-Neue-Thin.eot');
	src: url('./fonts/Helvetica-Neue-Thin.eot') format('eot'),
	url('./fonts/Helvetica-Neue-Thin.woff2') format('woff2'),
	url('./fonts/Helvetica-Neue-Thin.woff') format('woff'),
	url('./fonts/Helvetica-Neue-Thin.ttf') format('truetype'),
	url('./fonts/Helvetica-Neue-Thin.svg') format('svg');
}
```

# 5. JavaScript ES6
WordPressify supports ES6 JavaScript with [Babel](https://babeljs.io/). Babel has support for the latest version of JavaScript through syntax transformers. These plugins allow you to use new syntax, right now without waiting for browser support.

## Write ES6 JavaScript
Your JavaScript code should be located in:
```
src/assets/js/
```

WordPressify will watch for changes under the js directory and bundle the code in a single file, which will be included in the footer of the page as:
```
footer-bundle.js
```

Check the gulp configuration to learn more about how JavaScript is generated.

# 6. External Libraries
Including external JavaScript libraries is as simple as installing the npm script and including it in the **gulpfile.js**
```javascript
/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = [
	'./node_modules/jquery/dist/jquery.js',
	'./node_modules/nprogress/nprogress.js',
	'./node_modules/aos/dist/aos.js',
	'./node_modules/isotope-layout/dist/isotope.pkgd.js'
];
const footerJS = [
	'./src/assets/js/**'
];
//--------------------------------------------------------------------------------------------------
```

You can include the scripts in the head of the page before the DOM is loaded by placing them in the **headerJS** array or in the footer of the page after the DOM is loaded in the **footerJS** array. Only footer scripts are processed with Babel thus supporting ES6, however you can change this in the configuration if you want to run both header and footer scripts with Babel.

A build restart is required for changes to take effect.

# 7. Build Backups
While coding you will find yourself uploading dummy content to the WordPress build server, e.g. images or other media stored in **wp-content**. WordPressify allows you to back up the current state of the build which will include all server files. To back up your build run the command:
```
npm run backup
```

Files will be compressed in a zip file and stored in the directory:
```
backups/
```

# 8. Code Style Rules
WordPressify comes with its own set of code style rules:
```
.stylelintrc
```

## Lint CSS
Before pushing changes make sure you have clean and consistent CSS. Run [stylelint](https://stylelint.io/) with the command:
```
npm run lint:css
```

# 9. Database
## MySQL/MariaDB Server
After installing WordPressify you will still need a database to store WordPress content. The recommended solution is to install either [MySQL](https://dev.mysql.com/downloads/mysql/) ([installation instructions](https://dev.mysql.com/doc/refman/5.7/en/installing.html)) or [MariaDB](https://mariadb.com/downloads/mariadb-tx) ([installation instructions](https://mariadb.com/products/get-started)) on your local machine.

## Remote Database
You are free to use remote databases. Please note that this will affect the speed depending on the connection.

# 10. Deployment
The recommended solution is to go with [WP Pusher](https://wppusher.com/). It is easy and quick to deploy automatically from GitHub or other services. The first step is to download the WordPress plugin from: https://wppusher.com/

Then navigate to your WordPress administration on your live site and install the downloaded plugin: Plugins -> Add New -> Upload Plugin -> Install Now.

Activate the plugin and navigate to the plugin page **WP Pusher**. Click on the GitHub or any other tab and obtain a token by pressing the button on the page, then copy and save the token.

At this point go to your terminal, navigate to your WordPressify project and generate your distribution files with the command:
```
npm run prod
```

Navigate to your theme distribution files on: 
```
dist/theme/<themeName>
```

Create a git repository and push all the files on GitHub. This repository will have only the theme distribution files.

Once the files are on GitHub you can get back to the WordPress administration on the WP Pusher plugin page and follow the **Next Steps**, click on **Install a theme**.

On Repository host we choose GitHub, then click on **Pick from GitHub** and choose the newly created repository with the distribution files. Then install & activate the theme.

## Automated Deployments
**Push-to-Deploy** if you want automatic deployments to happen when you do a push to the distribution repository.
In this case you have to create a Webhook from your GitHub's repository page. 

First navigate to the WP Pusher plugin page and click on **Themes**, it will show you the list of the templates you have installed through the plugin itself. Click on **Show Push-to-Deploy URL** to get the Payload URL. 

Now get back to GitHub and navigate to your distribution repository and click on: Settings -> Webhooks -> Add webhook. Now past the URL and click **Add webhook**. 

This should enable automatic deployment on any push to the chosen GitHub repository.

**Note:** WP Pusher if **free** only with **public** repositories.

# 11. Cleanup Default Theme
The default theme comes as a theme sample to show how WordPressify combines everything together. If you want to remove the default theme type the command:
```
npm run fresh-start
```

This will **immediately** remove the default styles and leave a minimal viable theme with basic PHP WordPress loops and other useful features.

# 12. Windows Installation
**[How to install WordPressify on Windows?](https://www.youtube.com/watch?v=J8ZNzKSeTSE)**

Assuming that you are using the latest version of Windows, and you have activated Windows Subsystem for Linux. Follow the instructions:

### Install lamp for PHP and MySQL
First refresh your package index:
```
sudo apt-get update
```

Then install the LAMP stack:
```
sudo apt-get install lamp-server^
```

For more informations check out: https://help.ubuntu.com/community/ApacheMySQLPHP

### Start MySQL
```
sudo service mysql start
```

Now let's connect to the MySQL Server:
```
sudo mysql
```

Change the **root** password to "123456789":
```
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '123456789';
```

Reload privileges:
```
FLUSH PRIVILEGES;
```

### Install Node
```
curl -sL https://deb.nodesource.com/setup_11.x | sudo -E bash -
```

```
sudo apt-get install -y nodejs
```

That's it. Now just follow the WordPressify installation instructions.

# Changelog
**v0.2.3**
- 🚀 RELEASE: Improved installation speed for global dependencies.
- BREAKING CHANGE: It is required to update WordPressify: `sudo npm install wordpressify -g`.

**v0.2.2**
- 👌 IMPROVE: Meta.

**v0.2.1**
- 🚀 RELEASE: Update dependencies.

**v0.2.0**
- 🐛 FIX: Typo.

**v0.1.9**
- 🐛 FIX: Dependencies.

**v0.1.8**
- 📦 NEW: Run WordPressify globally from NPM.

**v0.1.7**
- 🚀 RELEASE: Remove WordPressify template from main repository.
- 👌 IMPROVE: Simple & unstyled boilerplate code. Stay fresh!

**v0.1.6**
- 📦 NEW: Upgrade to Gulp 4.
- 📦 NEW: Rewrote all tasks into functions.
- 👌 IMPROVE: Updated file structure.

**v0.1.5**
- 📦 NEW: Upgrade to Babel 7
- 🐛 FIX: Removed deprecated `postcss-cssnext` in favor of `postcss-preset-env`.

**v0.1.4**
- 👌 IMPROVE: Added cleanup command to flush the default theme and have a fresh start.

**v0.1.3**
- 👌 IMPROVE: Added support for bitmap and SVG minification, in the production build.
- 📖 DOC: Added documentation for deployment process.

**v0.1.2**
- 👌 IMPROVE: Converted all variables from 'var' to 'const'.
- 👌 IMPROVE: Replaced long anonymous function with ES6 arrow syntax.
- 🐛 FIX: Spelling errors.

**v0.1.1**
- 📦 NEW: Added support for `src/plugins`.

**v0.1.0**
- 👌 IMPROVE: Code readability.
- 👌 IMPROVE: Removed unused packages.
- 📦 NEW: Build success and error messages.
- 👌 IMPROVE: Tasks cleanup.

**v0.0.9**
- 📖 DOC: Update documentation.

**v0.0.8**
- 👌 IMPROVE: Name change.

**v0.0.7**
- 🐛 FIX: Fix placemente of `DISABLE_WP_CRON`.

**v0.0.6**
- 👌 IMPROVE: Theme cleanup.
- 👌 IMPROVE: Consistent code styles.

**v0.0.5**
- 🐛 FIX: Activated `DISABLE_WP_CRON` to prevent Node freezing.
- 🚀 RELEASE: Back up your build files with all `wp-content` uploads.

**v0.0.4**
- 🐛 FIX: Whitelabel template.
- 🐛 FIX: Renamed classes.
- 👌 IMPROVE: Refactored CSS structure.
- 📦 NEW: Meet WordPressify.

**v.0.0.3**
- 👌 IMPROVE: Simplified build logic.
- 👌 IMPROVE: Install WordPress only once with `npm run install:wordpress`.
- 👌 IMPROVE: Cleaner distribution task.

**v0.0.2**
- 🐛 FIX: Bugfixes.
- 📦 NEW: Watch and store new content in `wp-content/uploads`.

# License
MIT

