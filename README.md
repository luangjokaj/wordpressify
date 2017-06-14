# Wordpress Theme Build

A build system for developing WordPress themes using Gulp. The build runs a local PHP Web Server, all you need to run your local development environment is a mysql database, which you can get for free at: [FreeSQLDatabase](http://www.freesqldatabase.com/) 

___

### Features ⚡️
* Processing styles using PostCSS with CSSNext
* Babel Transpiler for JavaScript (ES6)
* JavaScript Concatenating and Minification
* Image Compression
* Fetching latest WordPress version
* Local development PHP Server running WordPress
* Live-Reload
* Style Injection
* Distribution Files

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

## Image Optimization 🌅
For image optimization and SVG compression run:
```
$ npm run images
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

___