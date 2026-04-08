# Changelog

**v0.6.2**

- fix: store `.gitignore` as `gitignore_template` since npm never includes `.gitignore` in published packages.

---

**v0.6.1**

- fix: add `.npmignore` so npm includes dot files in the published package.
- refactor: simplify installer to copy files directly to final paths, removing all flat-copy-then-rename logic.

---

**v0.6.0**

- chore: update WordPress to 6.9, PHP to 8.5, and Xdebug to 3.5.1.
- chore: update dependencies.
- refactor: replace GitHub downloads with local file copies in installer, removing `download` and `execa` dependencies.
- refactor: replace `chalk` and `prompts` with native ANSI codes and Node's `readline`, reducing installer dependencies from 100+ to 18 packages.
- fix: export and export:backup scripts now auto-stop Docker containers when the stack was not already running, while preserving the correct exit code.
- fix: resolve wordpress-chmod race condition by adding a healthcheck to the WordPress service.
- fix: nginx 400 Bad Request error by increasing `large_client_header_buffers`.
- fix: remove obsolete `version` key from docker-compose.yml and add default for `THEME_NAME`.
- fix: remove missing `package-lock.json` from Dockerfile-nodejs COPY.
- feat: add Docker availability check with colored error message before running Docker commands.
- feat: add Doccupine to installer output and README with referral links.
- docs: add CLAUDE.md for Claude Code guidance.
- docs: reformat CHANGELOG to follow Conventional Commits.

---

**v0.5.0**

- feat: updated the default theme, replacing PHP templates with HTML and modern block-based markup. Learn more about block-based themes [here](https://developer.wordpress.org/block-editor/explanations/architecture/key-concepts/).
- feat: added code formatters: PHP CS Fixer for PHP code consistency and Prettier for HTML, JavaScript, and CSS.
- feat: added `USE_POLLING` environment variable to enable file watcher polling as needed.
- fix: enhanced build tasks so deleted files are automatically removed. Also resolved an issue where new images or fonts weren't being detected by the watch task.
- fix: replaced `cssnano` with `gulp-clean-css` for improved CSS optimization.
- feat: update php 8.3
- feat: update default theme.

**v0.4.0**

A new major release simplifies WordPressify even further. Removes NodeJS as a global dependency, leaving Docker as the only main dependency. This allows WordPressify to run cross-platform without changing anything.

- feat: `npm run dev` replaced with `npm run  start` or `docker compose up`
- feat: `npm run env:rebuild` replaced with `npm run rebuild` or `docker compose down -v`, then `docker compose build`
- feat: `npm run prod` replaced with `npm run export` or `docker compose run --rm nodejs npm run prod`
- feat: `npm run backup` replaced with `npm run export:backup` or `docker compose run --rm nodejs npm run backup`
- feat: `npm run lint:css` replaced with `npm run lintcss` or `docker compose run --rm nodejs npm run lint:css`
- docs: update documentation and website.
- fix: Windows build.
- fix: Linux Docker permissions.
- fix: Browsersync proxy server while using `wp-admin`

- A special thank you to [@mountainash ](https://github.com/mountainash) for this contribution.

### Special thank you

- [@mountainash ](https://github.com/mountainash) - For making this release possible.
- [@vandr0iy](https://github.com/vandr0iy) - For fixing Linux Docker permissions.

**[Release Notes](https://github.com/luangjokaj/wordpressify/discussions/126)**

---

**v0.3.0**

- docs: improve documentation and website.
- refactor: default header viewport meta tag.

---

**v0.2.9-32**

- feat: add formatting to WordPressify.

---

**v0.2.9-31**

- refactor: use latest version of WordPress and set FS_DIRECT to true.

---

**v0.2.9-30**

- refactor: show wp errors in xdebug folder and update .gitignore.

---

**v0.2.9-29**

- fix: Nginx config for wp query parameters.

---

**v0.2.9-28**

- fix: remove variable.css from download files.

---

**v0.2.9-27**

- fix: add back autoprefixer.

---

**v0.2.9-26**

- fix: remove un-used file.

---

**v0.2.9-25**

- fix: remove un-used import.

---

**v0.2.9-24**

- feat: replace Tailwind with [Cherry Design System](https://cherry.design).

---

**v0.2.9-23**

- chore: update dependencies.

---

**v0.2.9-22**

- refactor: output log.

---

**v0.2.9-21**

- docs: improve documentation and website.

---

**v0.2.9-20**

- refactor: default theme.

---

**v0.2.9-19**

- refactor: default theme.

---

**v0.2.9-18**

- fix: missing `.editorconfig` from installation.
- refactor: code style consistency.

---

**v0.2.9-17**

- refactor: default theme.

---

**v0.2.9-16**

- chore: update dependencies.

---

**v0.2.9-15**

- docs: improve documentation and website.

---

**v0.2.9-14**

- refactor: default theme.

---

**v0.2.9-13**

- fix: url.

---

**v0.2.9-12**

- refactor: default theme.

---

**v0.2.9-10**

- docs: improve documentation and website.

---

**v0.2.9-8**

- refactor: Browsersync change open option to local.

---

**v0.2.9-7**

- fix: run `stylesDev` when template files are changed. Solves Tailwind CSS purge.

---

**v0.2.9-6**

- feat: add support for Tailwind CSS.
- refactor: disable Nginx cache for dev server.

---

**v0.2.9-4**

- fix: missing welcome.html

---

**v0.2.9-3**

- feat: welcome page while WordPressify initializes.
- refactor: remove unused package and cleanup default styles.
- docs: improve documentation and website.

---

**v0.2.9**

- feat: development server using Docker with Xdebug support.
- feat: MariaDB database out of the box running in Docker.
- feat: `.editorconfig` for code style consistency.
- feat: GitHub Actions for simple testing.
- feat!: Docker is a required global dependency.
- A special thank you to [@ribaricplusplus ](https://github.com/ribaricplusplus) for this contribution.

---

**v0.2.8-11**

- chore: remove `eslintrc.`

---

**v0.2.8**

- feat: add ESLint with WordPress code standards rules.

---

**v0.2.7**

- chore: update version.
- fix: readme documentation on install.
- fix: cron jobs new formatting.

---

**v0.2.6**

- feat: install files from versioned release instead of `master` branch.

---

**v0.2.5**

- refactor: install only required dependencies.
- chore: update dependencies.

---

**v0.2.4**

- docs: improve documentation.

---

**v0.2.3**

- perf: improved installation speed for global dependencies.
- feat!: it is required to update WordPressify: `sudo npm install wordpressify -g`.

---

**v0.2.2**

- refactor: meta.

---

**v0.2.1**

- chore: update dependencies.

---

**v0.2.0**

- fix: typo.

---

**v0.1.9**

- fix: dependencies.

---

**v0.1.8**

- feat: run WordPressify globally from NPM.

---

**v0.1.7**

- chore: remove WordPressify template from main repository.
- refactor: simple & unstyled boilerplate code. Stay fresh!

---

**v0.1.6**

- feat: upgrade to Gulp 4.
- feat: rewrote all tasks into functions.
- refactor: updated file structure.

---

**v0.1.5**

- feat: upgrade to Babel 7
- fix: removed deprecated `postcss-cssnext` in favor of `postcss-preset-env`.

---

**v0.1.4**

- refactor: added cleanup command to flush the default theme and have a fresh start.

---

**v0.1.3**

- refactor: added support for bitmap and SVG minification, in the production build.
- docs: added documentation for deployment process.

---

**v0.1.2**

- refactor: converted all variables from 'var' to 'const'.
- refactor: replaced long anonymous function with ES6 arrow syntax.
- fix: spelling errors.

---

**v0.1.1**

- feat: added support for `src/plugins`.

---

**v0.1.0**

- refactor: code readability.
- refactor: removed unused packages.
- feat: build success and error messages.
- refactor: tasks cleanup.

---

**v0.0.9**

- docs: update documentation.

---

**v0.0.8**

- refactor: name change.

---

**v0.0.7**

- fix: fix placement of `DISABLE_WP_CRON`.

---

**v0.0.6**

- refactor: theme cleanup.
- refactor: consistent code styles.

---

**v0.0.5**

- fix: activated `DISABLE_WP_CRON` to prevent Node freezing.
- feat: back up your build files with all `wp-content` uploads.

---

**v0.0.4**

- fix: whitelabel template.
- fix: renamed classes.
- refactor: refactored CSS structure.
- feat: meet WordPressify.

---

**v.0.0.3**

- refactor: simplified build logic.
- refactor: install WordPress only once with `npm run install:wordpress`.
- refactor: cleaner distribution task.

---

**v0.0.2**

- fix: bugfixes.
- feat: watch and store new content in `wp-content/uploads`.

---

**v0.0.1**

- feat: initial release of WordPressify.
