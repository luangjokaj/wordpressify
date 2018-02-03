
[![WordPressify Logo](https://i.imgur.com/5dVJS70.png)](http://www.wordpressify.co/)

# WordPressify v0.1.3 [![Dependencies](https://david-dm.org/luangjokaj/wordpressify/dev-status.svg)](https://david-dm.org/luangjokaj/wordpressify?type=dev)
A build system designed to automate your WordPress development workflow.

http://www.wordpressify.co/ 

### Introduction
WordPressify is a modern workflow for your WordPress development, with an integrated web server and auto-reload. Style pre-processors and ES6 ready.

## Features

- **DEV SERVER**
A development server for PHP based in Node. Powered by BrowserSync.
- **AUTO-RELOAD**
Watches for all your changes and reloads in real-time.
- **STYLES**
Styles pre-processors: PostCSS or Scss with sourcemaps.
- **JAVASCRIPT ES6**
Babel compiler for writing next generation JavaScript.
- **EXTERNAL LIBRARIES**
Easy import for external JavaScript libraries and npm scripts.
- **CUSTOMIZABLE**
Flexible build customization, managed by Gulp tasks.

# 1. Installing Node

WordPressify requires Node v7.5+. This is the only global dependency. You can download Node **[here](https://nodejs.org/)**.

Node.js is a JavaScript runtime built on Chrome’s V8 JavaScript engine. Node.js uses an event-driven, non-blocking I/O model that makes it lightweight and efficient. Node.js’ package ecosystem, npm, is the largest ecosystem of open source libraries in the world.

# 2. Setup Project
To install WordPressify you need to clone the repository from GitHub:
```
git clone https://github.com/luangjokaj/wordpressify
```
- This will clone the repostiry on your local machine. Navigate to the newly created folder and install the dependencies:

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

- Let’s begin, on the first run we need to install WordPress, we do this once by running the command:

```
npm run install:wordpress
```

- It will fetch the latest WordPress version, which is the build we use for the development server.

**START WORKFLOW**

- We are ready to start our development server with the command:

```
npm run dev
```

- If you are running a fresh installation, you will have to setup the general information for the WordPress wizard (site name, description, database etc…).
- You are ready to go! Happy coding!

**WORDPRESS PLUGINS**

- If you want to add or build WordPress plugins, you can do that from the directory:

```
src/plugins
```

**PRODUCTION TEMPLETE**

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

# 3. Styles, PostCSS and Scss
## PostCSS
By default we support [PostCSS](http://postcss.org/), it is a similar preprocessor like Sass, Less or other preprocessors but it can do much more. On top of that is 3x faster than Sass or 4x faster than Less. These features come in the shape of PostCSS plugins. Think of these like using lego, where each piece is a different feature that can transform your CSS in some way. PostCSS lets you stick together these pieces so that you can build up your own feature set, adding and removing plugins as and when you need them. [CSSNext](http://cssnext.io/) is installed by default. Read more about PostCSS [here](https://ashleynolan.co.uk/blog/postcss-a-review).

**POSTCSS PLUGINS**

```javascript
//--------------------------------------------------------------------------------------------------
/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
 ------------------------------------------------------------------------------------------------- */
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
//--------------------------------------------------------------------------------------------------
```

As you can notice from the code below we have 2 different sets of plugins. One for the development environment (pluginsDev) and one for the production task (pluginsProd).

**WRITING STYLES**

The starting point for styles is the file:

```
src/styles/styles.css
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

## SASS
WordPressify is super flexible. You can install Sass and use it as a main style preprocessor. First you need to install it:

```
npm install gulp-sass --save-dev
````

Then you need to include sass in the gulpfile.js

```javascript
const sass = require('gulp-sass');
````

Change the gulp tasks style-dev to:

```javascript
gulp.task('style-dev', () => {
	return gulp
	.src("src/style/style.scss")
		.pipe(sourcemaps.init())
		.pipe(sass().on("error", sass.logError))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest("build/wordpress/wp-content/themes/" + themeName))
		.pipe(browserSync.stream({ match: "**/*.css" }));
});
```

Change the gulp tasks style-prod to:


```javascript
gulp.task('style-prod', () => {
	return gulp.src('src/style/style.scss')
		.pipe(sass().on("error", sass.logError))
		.pipe(gulp.dest('dist/themes/' + themeName))
});
```

Also the watch task has to be changed in order to watch for .scss filetypes:

```javascript
gulp.task('watch', () => {
	gulp.watch(['src/style/**/*.scss'], ['style-dev']);
	gulp.watch(['src/js/**'], ['reload-js']);
	gulp.watch(['src/fonts/**'], ['reload-fonts']);
	gulp.watch(['src/theme/**'], ['reload-theme']);
});
```

# 4. Fonts and Images
## Images
Your template image assets are recommended to be stored in your theme directory:

```
src/theme/img/
```

Ideally all the heavy bitmaps should be managed through the [Media Library](https://codex.wordpress.org/Media_Library_Screen) of WordPress. So try and only store SVG or minimal assets in your theme directory to keep the template as light as possible.

## Fonts
Fonts are always special. Your fonts should be stored in:

```
src/fonts/
```

Then you can include them in your **CSS**:

```
@font-face {
	font-family: 'Helvetica Neue Thin';
	src: url('fonts/Helvetica-Neue-Thin.eot?#iefix');
	src: url('fonts/Helvetica-Neue-Thin.eot?#iefix') format('eot'),
	url('fonts/Helvetica-Neue-Thin.woff2') format('woff2'),
	url('fonts/Helvetica-Neue-Thin.woff') format('woff'),
	url('fonts/Helvetica-Neue-Thin.ttf') format('truetype'),
	url('fonts/Helvetica-Neue-Thin.svg#e3b7d1e7c160') format('svg');
}
```

# 5. JavaScript ES6

WordPressify supports ES6 JavaScript with [Babel](https://babeljs.io/). Babel has support for the latest version of JavaScript through syntax transformers. These plugins allow you to use new syntax, right now without waiting for browser support.

## Write ES6 JavaScript
Your JavaScript code should be located in:

```
src/js/
```

WordPressify will watch for changes under the js directory and bundle the code in a single file, which will be included in the footer of the page as:

```
footer-bundle.js
```
Check the Gulp configuration to learn more about how JavaScript is generated.

# 6. External Libraries

Including external JavaScript libraries is as simple as installing the npm script and including it in the **gulpfile.js**

```javascript
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
//--------------------------------------------------------------------------------------------------
```

You can include the scripts in the head of the page before the DOM is loaded by placing them in the **headerJS** array or in the footer of the page after the DOM is loaded in the array **footerJS**. Only footer scripts are processed with Babel thus supporting ES6, however you can change this in the configuration if you want to run both header and footer scripts with Babel.

A build restart is required for changes to take effect.


# 7. Build Backups

While coding you will find yourself uploading dummy content in the WordPress build server. These might be images or other media stored in **wp-content**. WordPressify allows you to backup the current state of the build which will include all server files. To backup your build run the command:

```
$ npm run backup
```

Files will be compressed in a ZIP and stored in the directory:

```
backups/
```

# 8. Code Styles

WordPressify comes with its own set of code style rules that can be imported into IntelliJ. The codestyle file can be found in the directory:

```
tools/IntelliJ.xml
```

## Lint CSS

Before pushing changes make sure you have clean and consistent styles, run [Stylelint](https://stylelint.io/) with the command:
```
$ npm run lint:css
```

# 9. Database
## MySQL Server
After installing WordPressify you will still need a database to connect with. The recommended solution is to install [MySQL](https://dev.mysql.com/downloads/mysql/) on your local machine and follow the [installation instructions](https://dev.mysql.com/doc/refman/5.7/en/installing.html).

## Remote Database
You are free to use remote databases, please note that this will affect the speed depending on the connection.

# Changelog

**v0.1.3**
- Added support for bitmap and svg minification, in the production build.

**v0.1.2**
- Converted all variables from 'var' to 'const'.
- Replaced long anonymous function with ES6 arrow syntax.
- Fixed spelling errors.

**v0.1.1**
- Added support for `src/plugins`

**v0.1.0**
- Code readability.
- Removed unused packages.
- Build success & error messages.
- Tasks cleanup.

**v0.0.9**
- Update documentation.

**v0.0.8**
- Name change.

**v0.0.7**
- Fix placemente of `DISABLE_WP_CRON`.

**v0.0.6**
- Theme clenup.
- Consistent code styles.

**v0.0.5**
- Activated `DISABLE_WP_CRON` to prevent Node freezing.
- Backup your build files with all `wp-content` uploads.

**v0.0.4**
- Whitelabel template.
- Renamed classes.
- Refactored css structure.
- Meet WordPressify.


**v.0.0.3**
- Simplified build logic.
- Install WordPress only once with `npm run install:wordpress`
- Cleaner distribution task.

**v0.0.2**
- Bugfixes
- Watch and store new content in `wp-content/uploads`.

# License
MIT
