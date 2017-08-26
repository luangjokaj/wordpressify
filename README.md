# WordPress Theme Builder [![Dependencies](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder/dev-status.svg)](https://david-dm.org/luangjokaj/gulp-wordpress-theme-builder?type=dev)

A build system for developing WordPress themes using Gulp. On the development environment the build runs a local PHP web server, it uses Babel transpiler for JavaScript and it bundles CSS with PostCSS and CSSNext. You will still need an sql database, get one for free at: [FreeSQLDatabase](http://www.freesqldatabase.com/) or run it by yourself.

![Wordpress Theme Builder](http://i.imgur.com/ml9KHWN.png)

The advantage of using the WordPress Theme Builder is the quick setup and no need to worry about setting up a running PHP server. The build takes care of everything.

___

### Features ⚡️
* Processing styles using PostCSS with CSSNext
* Babel Transpiler for JavaScript (ES6)
* JavaScript Concatenating and Minification
* Image Compression
* Fetching latest WordPress version
* Local development PHP Server running WordPress
* Live-Reload (PHP Theme Files)
* Live-Style Injection (CSS Style Files)
* Distribution Files (Theme Only)

___

# Setup ⚙️
This project requires node version 6. This is the only global dependency.
* NodeJS http://nodejs.org/

## Installation ⏳
* Clone Repository: https://github.com/luangjokaj/gulp-wordpress-theme-builder
* Install node packages:
```
$ npm install
```
Make sure Gulp is installed Globally:
```
$ npm install gulp -g
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
var themeName = 'goldengate';
```

# Changelog

v0.0.2
* Bugfixes
* Watch and store new content in `wp-content/uploads`.

# License
MIT