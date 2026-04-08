import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import ora from "ora";
import { dim, bgGreen, bgYellow, bgWhite } from "./colors.js";
import { clearConsole } from "./clearConsole.js";
import { printNextSteps } from "./printNextSteps.js";

const repoRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..", "..");

const theCWD = process.cwd();
const theCWDArray = theCWD.split("/");
const theDir = theCWDArray[theCWDArray.length - 1];

const run = () => {
  // Init
  clearConsole();

  // Files to copy from the package (source path -> destination path)
  const filesToCopy = [
    ".babelrc",
    ".dockerignore",
    ".editorconfig",
    ".env_example",
    ".gitignore",
    ".php-cs-fixer.php",
    ".prettierrc",
    ".stylelintrc",
    "docker-compose.yml",
    "Dockerfile-nodejs",
    "Dockerfile-wordpress",
    "gulpfile.js",
    "LICENSE",
    "README.md",

    "src/assets/css/style.css",
    "src/assets/css/wordpressify.css",

    "src/assets/fonts/inter/Inter-VariableFont_slnt,wght.woff2",
    "src/assets/fonts/fira-code/FiraCode-VariableFont_wght.woff2",

    "src/assets/img/logo.svg",
    "src/assets/img/404-image.webp",

    "src/assets/js/main.js",

    "src/theme/parts/footer-columns.html",
    "src/theme/parts/footer-newsletter.html",
    "src/theme/parts/footer.html",
    "src/theme/parts/header.html",
    "src/theme/parts/sidebar.html",
    "src/theme/parts/vertical-header.html",

    "src/theme/patterns/comments.php",
    "src/theme/patterns/footer-centered.php",
    "src/theme/patterns/footer-columns.php",
    "src/theme/patterns/footer-newsletter.php",
    "src/theme/patterns/footer-social.php",
    "src/theme/patterns/footer.php",
    "src/theme/patterns/header-centered.php",
    "src/theme/patterns/header-columns.php",
    "src/theme/patterns/header-large-title.php",
    "src/theme/patterns/header.php",
    "src/theme/patterns/hidden-404.php",
    "src/theme/patterns/hidden-blog-heading.php",
    "src/theme/patterns/hidden-search.php",
    "src/theme/patterns/hidden-sidebar.php",
    "src/theme/patterns/hidden-written-by.php",
    "src/theme/patterns/more-posts.php",
    "src/theme/patterns/post-navigation.php",
    "src/theme/patterns/template-query-loop.php",

    "src/theme/templates/404.html",
    "src/theme/templates/archive.html",
    "src/theme/templates/home.html",
    "src/theme/templates/index.html",
    "src/theme/templates/page-no-title.html",
    "src/theme/templates/page.html",
    "src/theme/templates/search.html",
    "src/theme/templates/single.html",

    "src/theme/functions.php",
    "src/theme/index.php",
    "src/theme/screenshot.png",
    "src/theme/theme.json",

    "config/php.ini",
    "config/nginx/nginx.conf",

    "scripts/check-docker.js",
  ];

  // installer/package.json is copied as the project's package.json
  const specialFiles = [{ from: "installer/package.json", to: "package.json" }];

  // Start
  console.log("\n");
  console.log(
    "📦 ",
    bgYellow(` Installing WordPressify files in: → ${bgGreen(` ${theDir} `)}\n`),
    dim(`\n In the directory: ${theCWD}\n`),
  );

  const spinner = ora({ text: "" });
  spinner.start(`1. Creating WordPressify files inside → ${bgWhite(` ${theDir} `)}`);

  // Create directories and copy files directly to final paths
  try {
    // Create empty directories that have no files
    fs.mkdirSync(path.join(theCWD, "src/assets/css/parts"), { recursive: true });
    fs.mkdirSync(path.join(theCWD, "src/assets/css/patterns"), { recursive: true });
    fs.mkdirSync(path.join(theCWD, "src/plugins"), { recursive: true });

    // Copy each file directly to its final destination
    for (const relativePath of filesToCopy) {
      const source = path.join(repoRoot, relativePath);
      const dest = path.join(theCWD, relativePath);
      fs.mkdirSync(path.dirname(dest), { recursive: true });
      fs.copyFileSync(source, dest);
    }

    // Copy files that need renaming
    for (const { from, to } of specialFiles) {
      const source = path.join(repoRoot, from);
      const dest = path.join(theCWD, to);
      fs.copyFileSync(source, dest);
    }
  } catch (err) {
    console.error(err);
    process.exit(1);
  }

  spinner.succeed();

  spinner.start("2. WordPressify is ready to go ⚡");
  spinner.succeed();

  // Done
  printNextSteps();
};

export { run };
