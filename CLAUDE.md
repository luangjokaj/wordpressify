# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPressify is a Docker-based WordPress block theme development workflow. It provides an automated build pipeline (Gulp + PostCSS + Babel), live reloading via BrowserSync, and a production export that generates a distributable theme zip.

The project also ships a CLI installer (`npx wordpressify`) that scaffolds new projects by downloading files from GitHub.

## Commands

All npm scripts run from the `installer/package.json` context (the working directory after install). The root `package.json` is only for the CLI installer published to npm.

```bash
# Development
npm start              # docker compose up (starts all services)
npm run build          # docker compose build (rebuild images)
npm run delete         # docker compose down -v (remove containers + volumes)
npm run rebuild        # full teardown + rebuild

# Inside Docker (these run via gulp in the nodejs container)
npm run dev            # gulp dev - watch, compile, BrowserSync on port 3010
npm run prod           # gulp prod - minified build to ./dist/
npm run backup         # gulp backup - timestamped zip of build/ to ./backups/

# Docker-wrapped commands
npm run export         # runs prod build in Docker, auto-stops containers if stack wasn't already running
npm run export:backup  # same as above but for backup
npm run lintcss        # stylelint via Docker
```

## Architecture

### Docker Services (docker-compose.yml)

Five services form the stack: **db** (MariaDB) -> **wordpress** (PHP-FPM with xdebug) -> **wordpress-chmod** (one-shot permissions fix) -> **webserver** (nginx on port 8080) -> **nodejs** (gulp + BrowserSync on port 3010).

The `nodejs` container mounts `src/`, `dist/`, `build/`, and `backups/` as volumes. File watchers use polling (`usePolling: true`) for Docker compatibility.

### Build Pipeline (gulpfile.js)

The gulpfile is ES module-based (~380 lines). Key paths:

- **CSS**: `src/assets/css/style.css` -> PostCSS (easy-import, mixins, preset-env stage 0, autoprefixer) -> `build/wordpress/wp-content/themes/{THEME_NAME}/style.css`
- **JS header**: jQuery from node_modules -> concatenated + uglified
- **JS footer**: `src/assets/js/**` -> Babel -> concatenated + uglified
- **Theme files**: `src/theme/**` copied directly (block templates, patterns, parts, functions.php, theme.json)
- **Images/Fonts**: `src/assets/img/` and `src/assets/fonts/` copied to theme directory
- **Plugins**: `src/plugins/**` copied to wp-content/plugins

Production output goes to `./dist/themes/{THEME_NAME}/` with a zip at `./dist/{THEME_NAME}.zip`.

### Theme Structure

This is a WordPress **block theme** (Full Site Editing). Key files:

- `src/theme/theme.json` - Block theme settings (colors, spacing, typography, layout widths)
- `src/theme/templates/` - Block templates (index.html, single.html, page.html, etc.)
- `src/theme/parts/` - Template parts (header.html, footer.html, sidebar.html)
- `src/theme/patterns/` - Block patterns (PHP files)
- `src/theme/functions.php` - Enqueues styles/scripts

### Installer (installer/)

The CLI (`installer/index.js`) uses Commander for arg parsing and downloads ~77 files from the GitHub repo at a specific version tag. `installer/modules/run.js` handles the download and file organization logic.

## Environment

- `.env_example` documents available env vars: `PROXY_PORT` (default 3010) and `THEME_NAME` (default "wordpressify")
- PHP config at `config/php.ini` (xdebug, 2G memory limit, 100M upload limit)
- Nginx config at `config/nginx/nginx.conf` (fastcgi proxy to wordpress:9000)

## Code Style

- **CSS**: PostCSS with stage 0 features (nesting, custom media). Stylelint enforces tab indentation and allowed units (px, em, rem, vw, vh, deg, ms, %, s, dpi, pt, fr).
- **JS**: ES6+ transpiled via Babel (@babel/preset-env). jQuery is available globally.
- **Formatting**: Prettier with double quotes, semicolons, trailing commas, 80-char width, LF line endings.
- **Editor**: Tabs for indentation (except YAML: 2 spaces). See `.editorconfig`.
