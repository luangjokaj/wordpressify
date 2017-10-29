# Gulp WordPress Boilerplate [![Dependencies](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder/dev-status.svg)](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder?type=dev)

Gulp WordPress Boilerplate is a build system designed to automate the development workflow for WordPress themes. It runs a local PHP web server with auto reload, uses Babel transpiler for JavaScript (ES6) and it bundles CSS with PostCSS and CSSNext.

# Quick Setup
* [Screencasts Quick Installation](https://www.youtube.com/watch?v=SoLbiHSglSs)
* [Medium Article](https://medium.com/@luangjokaj/gulp-wordpress-boilerplate-simple-and-fast-workflow-for-theme-development-771a5f16fd3a)
* [Implemented theme using Gulp WordPress Boilerplate](https://lifes-kool.design/)

![Gulp WordPress Boilerplate](https://i.imgur.com/iTQAert.png)

The advantage of using the gulp-wordpress-boilerplate is the quick setup and no need to worry about setting up a running PHP server. The build takes care of everything.

___

### Features ⚡️
* Local PHP Server out of the box, with live reloads using [BrowserSync](https://www.browsersync.io/).
* Processing styles using [PostCSS](http://postcss.org/) with [CSSNext](http://cssnext.io/), sourcemaps supported.
* [Babel](https://babeljs.io/) Transpiler for JavaScript (ES6).
* JavaScript concatenation and minification.
* Easy import for third party JavaScript libraries.
* Automated local WordPress installation.
* Free sample template with WooCommerce support ([Live Demo](https://lifes-kool.design/)).
* Distribution Files — ZIP Ready to be Shipped 🚀

___

# Setup ⚙️
This project requires node version 6. This is the only global dependency.
* NodeJS http://nodejs.org/

## Installation ⏳
* Clone Repository: https://github.com/luangjokaj/gulp-wordpress-boilerplate
* Install node packages:
```
$ npm install
```
## Install Wordpress 
To download and install the latest version of Wordpress just run the `install:wordpress` task:
```
$ npm run install:wordpress
```
## Development 👾
To start the development server just run the `dev` task:
```
$ npm run dev
```

## Production 🎬
To build the production files run the `prod` task:
```
$ npm run prod
```

## Working Directories
* All the files that you will be working with can be found at: `src/`;
* The `.php` files of the template: `src/theme/`;
* The main `style.css` with the rest of the css includes: `src/style/`;
* Your JavaScript files: `src/js`;
* Fonts are always special: `src/fonts`;

Third party JavaScript libraries can be included in the Gulpfile.js configuration.

All the respective directories (fonts, js, style and theme) have specific watch tasks that run in Gulp.

___

### Technologies 🚀
* NodeJS
* Gulp
* browserSync
* PHP
* Babel
* PostCSS
* CSSNext
* WordPress

___

# Configuration

### Gulpfile.js

The name of the template has to be changed in the Gulp configuration file:

```javascript
/* -------------------------------------------------------------------------------------------------
Theme Name
 ------------------------------------------------------------------------------------------------- */
var themeName = 'lk-website';
```

Adding third party JavaScript libraries is as simple as installing them with NPM Node Package Manager and including the source files in the configuration:

```javascript
var headerJS = [
	'node_modules/jquery/dist/jquery.js',
	'node_modules/nprogress/nprogress.js',
	'node_modules/aos/dist/aos.js',
	'node_modules/isotope-layout/dist/isotope.pkgd.js'
];
var footerJS = [
	'node_modules/izimodal/js/iziModal.js',
	'src/js/**'
];
```

# Changelog

v.0.0.3
* Simplified build logic.
* Install WordPress only once with `npm run install:wordpress`
* Cleaner distribution task.

v0.0.2
* Bugfixes
* Watch and store new content in `wp-content/uploads`.

# License
MIT
