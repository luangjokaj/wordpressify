[![WordPressify Logo](https://i.imgur.com/5dVJS70.png)](https://www.wordpressify.co/)

[![Version](https://img.shields.io/github/package-json/v/luangjokaj/wordpressify)](https://www.wordpressify.co/) [![Dependencies](https://img.shields.io/david/luangjokaj/wordpressify)](https://www.wordpressify.co/)

A build system designed to automate your WordPress development workflow.

https://www.wordpressify.co/

- [Introduction](#introduction)
	- [Features](#features)
	- [What is WordPressify?](#what-is-wordpressify)
- [1. Installing Node.js and Docker](#1-installing-nodejs-and-docker)
- [2. Set Up Project](#2-set-up-project)
	- [Install WordPressify from NPM](#install-wordpressify-from-npm)
	- [Install WordPressify from Repository](#install-wordpressify-from-repository)
	- [Start Workflow](#start-workflow)
	- [Production Template](#production-template)
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
- [9. Using Xdebug](#9-using-xdebug)
	- [Xdebug on Linux](#xdebug-on-linux)
- [10. Changing PHP and Docker settings](#10-changing-php-and-docker-settings)
- [11. Deployment](#11-deployment)
	- [Automated Deployments](#automated-deployments)
- [12. Troubleshooting](#12-troubleshooting)
- [Changelog](CHANGELOG.md)
- [License](LICENSE)

## Introduction

| Information | Discord | Donate |
|:------------|:---------|:-------|
| [WordPressify](https://www.wordpressify.co) is a modern workflow for your WordPress development, with an integrated database, web server and auto-reload. CSS preprocessors and ES6 ready.| [![Discord server](https://svgshare.com/i/Lqc.svg)](https://discord.gg/uQFdMddMZw) | [![BuyMeACoffee](https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-1.svg)](https://www.buymeacoffee.com/luangjokaj) |

## Features
|👇|Includes|
|:-:|:---|
|📦| Dev Server with Xdebug|
|💽| MariaDB Database |
|🔥| Hot Reload & CSS Injection|
|🎨| PostCSS & Next Generation CSS|
|💨| TailwindCSS|
|⚙| Babel 7 - ES6 JavaScript|
|✂️| Source Maps|
|🎒| Code Minification|
|🌈| Image Compression|
|🤖| External Libraries|
|🛎| Production ready ZIP theme|

## What is WordPressify?
WordPressify is a simple tool that helps you build WordPress themes and plugins. It takes care of the development experience by providing a web server with a database out of the box, zero-configuration required.

WordPressify comes with a development server for running PHP under a proxy with BrowserSync. The data is stored in a pre-configured MariaDB database that works out of the box. Watches for all your changes and reloads the webpage in real-time. Style are preprocessors with PostCSS or Sass. Babel compiler for writing next-generation JavaScript. Source maps are supported for both CSS and JavaScript. WordPressify allows easy import of external JavaScript libraries and npm scripts, it has a flexible build and can be easily customized with gulp tasks.

[![video](https://i.imgur.com/g06S92G.png)](https://www.youtube.com/watch?v=o4MQYidejN4)

# 1. Installing Node.js and Docker
WordPressify requires **Node.js v12+** and **Docker Compose**.

### Node.js

Node.js is a JavaScript runtime built on Chrome’s V8 JavaScript engine. Node.js uses an event-driven, non-blocking I/O model that makes it lightweight and efficient. Node.js’ package ecosystem, npm, is the largest ecosystem of open source libraries in the world.

You can download Node.js **[here](https://nodejs.org/)**.

### Docker

A Docker container is a standard unit of software that packages up code and all its dependencies so the application runs quickly and reliably from one computing environment to another.

Instructions to download Docker Compose can be found **[here](https://docs.docker.com/compose/install)**.

If you're on Linux **make sure that you can [manage Docker as a non-root user](https://docs.docker.com/engine/install/linux-postinstall/)**.

# 2. Set Up Project
## File Structure
```
    ├── build/                   # Build files
    ├── config/                  # Nginx & PHP configs
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
    └── .env.in                  # Environment variables
    └── .gitignore               # Git ignored files
    └── .stylelintrc             # Stylelint configuration
    └── docker-compose.yml       # Docker configuration
    └── Dockerfile.in            # Docker file
    └── gulpfile.js              # Gulp configuration
    └── LICENSE                  # License agreements
    └── package-lock.json        # Packages lock file
    └── package.json             # Node.js packages
    └── README.md                # You are reading this
```

## Install WordPressify from NPM

To install WordPressify create a directory for the new WordPress website and from there run the command to generate the file structure:
```
npx wordpressify
```

That's it 🍾 easy as that. Now start the development workflow: [Start Workflow](#start-workflow)

Make sure **Docker is running**, otherwise this ☝ command will fail.

---

## Install WordPressify from Repository
To install WordPressify you need to clone the repository from GitHub:
```
git clone https://github.com/luangjokaj/wordpressify
```
- This will clone the repository on your local machine. Navigate to the newly created directory.

- Replace the file: `./package.json` with `./installer/package.json` and continue with the dependency installation.

**INSTALL DEPENDENCIES**

```
npm install
```

**BUILD ENVIRONMENT**

- On the first run, WordPressify needs to set up a local server and a database for the new WordPress installation, we do this once by running the command:
```
npm run env:build
```
Make sure **Docker is running**, otherwise this ☝ command will fail.

---

**CHANGE TEMPLATE NAME**

- At this point WordPressify is installed and ready to be used for the first time. Before starting, open **gulpfile.js** and edit your template name:
```javascript
/* -------------------------------------------------------------------------------------------------
Theme Name
 ------------------------------------------------------------------------------------------------- */
const themeName = 'wordpressify';
//--------------------------------------------------------------------------------------------------
```

## Start Workflow

- To start the development server run the command:
```
npm run dev
```
- You are ready to go! Happy coding! 🤓

Make sure **Docker is running**, otherwise this ☝ command will fail.

---

**BRING DOWN ENVIRONMENT**

- To stop the WordPressify server and database for the project run:
```
npm run env:stop
```

**REBUILD ENVIRONMENT**

- To rebuild the WordPressify project environment run:
```
npm run env:rebuild
```

### WordPress Plugins

- If you want to add or build WordPress plugins, you can do that from the directory:
```
src/plugins/
```
---

## Production Template

- To generate your distribution files run the command:
```
npm run prod
```

- The template will be saved as a zip file in:
```
dist/wordpressify.zip
```

# 3. CSS, PostCSS and Sass
## PostCSS
By default WordPressify supports [PostCSS](https://postcss.org/), a similar preprocessor to Sass, Less and others but with more functionality. On top of that PostCSS is 3x faster than Sass and 4x faster than Less. Features come in the shape of PostCSS plugins. Think of these like using Lego, where each piece is a different feature that can transform your CSS in some way. PostCSS lets you stick these pieces together so that you can build up your own feature set, adding and removing plugins as and when you need them. [postcss-preset-env](https://preset-env.cssdb.org//) is installed by default. Read more about PostCSS [here](https://ashleynolan.co.uk/blog/postcss-a-review).

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

**TAILWIND CSS**

[Tailwind CSS](https://tailwindcss.com/) is a utility-first CSS framework packed with classes like `flex`, `pt-4`, `text-center` and `rotate-90` that can be composed to build any design, directly in your markup. Tailwind comes pre-installed with WordPressify.

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
		.pipe(sass({includePaths: 'node_modules'}).on('error', sass.logError))
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
		.pipe(sass({includePaths: 'node_modules'})).on('error', sass.logError)
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

# 9. Using Xdebug

WordPressify comes with [Xdebug](https://xdebug.org/**) preconfigured so that you can easily debug, profile, and trace your application. The following is a description of how to setup Xdebug with WordPressify. If you're on Linux, be sure to check the Xdebug on the Linux section below.

**INSTALL THE XDEBUG EXTENSION**

Install the Xdebug extension for [Chrome](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc), [FireFox](https://addons.mozilla.org/en-GB/firefox/addon/xdebug-helper-for-firefox/) or [Safari](https://apps.apple.com/app/safari-xdebug-toggle/id1437227804?mt=12).

**PROFILING AND TRACING**

After installing the extension and running WordPressify, you can start profiling and tracing WordPress by simply selecting the proper option in the extension. Profiling information can be displayed using one of the cachegrind tools as described in [Xdebug documentation](https://xdebug.org/docs/profiler). The profile and trace data will be logged in the `xdebug` directory.

**STEP DEBUGGING**

If you want to do step debugging, you need to setup your IDE accordingly. Make sure to setup your IDE to listen on port 9003 for Xdebug connections. There are plugins for VS Code, PHPStorm, and other IDEs listed [here](https://xdebug.org/docs/step_debug#clients).

After setting up your IDE, select `Debug` in the Xdebug extension and reload the page.

## Xdebug on Linux

Xdebug needs additional configuration for Linux because of some Docker restrictions. Xdebug has to connect to the host machine from within Docker, which means it needs the host's ip. For MacOS and Windows that is resolved using a special DNS name, but that doesn't exist for Linux. You can read more [here](https://github.com/docker/for-linux/issues/264).

Make sure that the containers are running:
```
npm run env:start
```

Find the host ip that docker sees by connecting to the WordPressify website from your web browser, and then inspecting nginx logs:
```
docker-compose logs server
```

The first field will be your host IP address. Copy that host address and paste it inside `config/php.ini` as the value for `xdebug.remote_host`.

**RESTART PHP**
```
npm run env:restart
```

Xdebug should be working now.

# 10. Changing PHP and Docker settings

You can make changes to PHP and Docker files (the ones that don't have `.in` extension).

Change PHP settings in `config/php.ini` after starting WordPressify. To make your changes active, restart PHP:
```
npm run env:restart
```

If you make changes to `Dockerfile` or `docker-compose.yml`, then you must rebuild containers:
```
npm run env:rebuild
```

# 11. Deployment
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

This will **immediately** remove the default styles and leave a minimal viable theme with basic PHP WordPress loops and other useful features.

# 12. Troubleshooting
**ERROR: docker-compose: command not found**
- Docker is not installed. Please [install Docker](#1-installing-nodejs-and-docker), then try again.

**ERROR: Failed to execute script docker-compose**
- Make sure Docker is open and running, then try again.

**ERROR: Bind for 0.0.0.0:3020 failed: port is already allocated**
- Make sure there are no other Docker containers running the same port `3020`. You can stop all Docker containers with the command: `docker stop $(docker ps -a -q)` and try again.


---
- [Changelog](CHANGELOG.md)
- License: [MIT](LICENSE)
- WordPressify [Documentation Website](https://www.wordpressify.co/)
