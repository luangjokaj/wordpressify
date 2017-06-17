# WordPress Theme Builder

A build system for developing WordPress themes using Gulp. On the development environment the build runs a local PHP web server, it uses Babel transpiler for JavaScript and it bundles CSS with PostCSS and CSSNext. You will still need a sql database, which you can get for free at: [FreeSQLDatabase](http://www.freesqldatabase.com/) or run it by yourself.

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

Change theme name in the Gulp configuration file:

```javascript
/* -------------------------------------------------------------------------------------------------
	Theme Name
 ------------------------------------------------------------------------------------------------- */
var themeName = 'goldengate';
```