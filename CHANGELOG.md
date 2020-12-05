
# Changelog

**v0.2.9-7**
- 🐛 FIX: Run `stylesDev` when template files are changes. Solves Tailwind CSS purge.

**v0.2.9-6**
- 📦 NEW: Add support for Tailwind CSS.
- 👌 IMPROVE: Disable Nginx cache for dev server.

**v0.2.9-4**
- 🐛 FIX: Missing welcome.html

**v0.2.9-3**
- 📦 NEW: Welcome page while WordPressify initializes.
- 👌 IMPROVE: Remove unused package and cleanup default styles.
- 📖 DOC: Improve documentation and website.

**v0.2.9**
- 📦 NEW: Development server using Docker with Xdebug support.
- 📦 NEW: MariaDB database out of the box running in Docker.
- 📦 NEW: `.editorconfig` for code style consistency.
- 📦 NEW: GitHub Actions for simple testing.
- 💥 BREAKING CHANGE: Docker is a required global dependency.
- A special thank you to [@ribaricplusplus ](https://github.com/ribaricplusplus) for this contribution.

**v0.2.8-11**
- 🚀 RELEASE: Remove `eslintrc.`

**v0.2.8**
- 🚀 RELEASE: Add ESLint with WordPress code standards rules.

**v0.2.7**
- 🚀 RELEASE: Update version.
- 🐛 FIX: Readme documentation on install.
- 🐛 FIX: Cron jobs new formatting.

**v0.2.6**
- 🚀 RELEASE: Install files from versioned release instead of `master` branch.

**v0.2.5**
- 👌 IMPROVE: Install only required dependencies.
- 🚀 RELEASE: Update dependencies.

**v0.2.4**
- 📖 DOC: Improve documentation.

**v0.2.3**
- 🚀 RELEASE: Improved installation speed for global dependencies.
- 💥 BREAKING CHANGE: It is required to update WordPressify: `sudo npm install wordpressify -g`.

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