# Contributing to WordPressify

Thanks for your interest in contributing to WordPressify! This guide will help you get started.

## Getting Started

1. Fork the repository and clone your fork
2. Make sure you have [Docker](https://www.docker.com/) and [Node.js](https://nodejs.org/) (v16+) installed
3. Run `npx wordpressify` to scaffold a local development environment
4. Run `npm start` to spin up the Docker stack, then `npm run dev` inside the container to start developing

## Development Setup

The project uses a Docker-based workflow with five services: MariaDB, WordPress (PHP-FPM), nginx, a permissions helper, and a Node.js container running Gulp + BrowserSync.

Key commands:

```bash
npm start        # Start the Docker stack
npm run dev      # Watch, compile, and live-reload (runs inside the nodejs container)
npm run prod     # Production build to ./dist/
npm run lintcss  # Run Stylelint
npm run delete   # Tear down containers and volumes
npm run rebuild  # Full teardown + rebuild
```

BrowserSync runs on port **3010** and nginx on port **8080**.

## Making Changes

### Branching

- Create a feature branch from `master` (e.g., `feat/my-feature` or `fix/some-bug`)
- Keep changes focused - one feature or fix per branch

### Code Style

The project enforces consistent formatting via Prettier and EditorConfig:

- **Indentation**: Tabs (except YAML files, which use 2 spaces)
- **Quotes**: Double quotes in JS/JSON
- **Semicolons**: Always
- **Trailing commas**: Always
- **Line endings**: LF
- **Max line width**: 80 characters

CSS is written as PostCSS (stage 0 features like nesting and custom media) and linted with Stylelint. Run `npm run lintcss` before submitting CSS changes.

### Commit Messages

We use [Conventional Commits](https://www.conventionalcommits.org/). Format:

```
type(scope): description
```

Common types: `feat`, `fix`, `docs`, `chore`, `refactor`, `test`

Examples:

```
feat(theme): add dark mode support to theme.json
fix(docker): resolve healthcheck race condition
docs(readme): update installation instructions
refactor(installer): replace external deps with native node APIs
```

### Project Structure

```
src/
  assets/
    css/          # PostCSS source files
    js/           # ES6+ JavaScript
    img/          # Images (copied to theme)
    fonts/        # Fonts (copied to theme)
  theme/
    templates/    # Block templates (.html)
    parts/        # Template parts (.html)
    patterns/     # Block patterns (.php)
    functions.php # Theme functions
    theme.json    # Block theme configuration
  plugins/        # WordPress plugins
installer/        # CLI installer (published to npm)
config/           # PHP and nginx configuration
```

## Submitting a Pull Request

1. Make sure your code follows the style guidelines above
2. Run `npm run lintcss` if you changed any CSS
3. Test your changes locally with the full Docker stack
4. Push your branch and open a pull request against `master`
5. Describe what your PR does and why

## Reporting Bugs

Open an [issue](https://github.com/luangjokaj/wordpressify/issues) with:

- A clear description of the problem
- Steps to reproduce
- Expected vs. actual behavior
- Your environment (OS, Docker version, Node version)

## License

By contributing, you agree that your contributions will be licensed under the [MIT License](LICENSE).
