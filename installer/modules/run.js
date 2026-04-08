import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import ora from "ora";
import { dim, bgGreen, bgYellow, bgWhite } from "./colors.js";
import { handleError } from "./handleError.js";
import { clearConsole } from "./clearConsole.js";
import { printNextSteps } from "./printNextSteps.js";

const repoRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..", "..");

const theCWD = process.cwd();
const theCWDArray = theCWD.split("/");
const theDir = theCWDArray[theCWDArray.length - 1];

const run = () => {
  // Init
  clearConsole();

  // Files to copy from the package
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
    "installer/package.json",

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

  // Organise file structure
  const dotFiles = [
    ".babelrc",
    ".dockerignore",
    ".editorconfig",
    ".env_example",
    ".gitignore",
    ".php-cs-fixer.php",
    ".prettierrc",
    ".stylelintrc",
  ];
  const cssFiles = ["style.css", "wordpressify.css"];
  const interFiles = ["Inter-VariableFont_slnt,wght.woff2"];
  const firaCodeFiles = ["FiraCode-VariableFont_wght.woff2"];
  const imgFiles = ["logo.svg", "404-image.webp"];
  const jsFiles = ["main.js"];
  const themeFiles = ["functions.php", "index.php", "screenshot.png", "theme.json"];
  const partsFiles = [
    "footer-columns.html",
    "footer-newsletter.html",
    "footer.html",
    "header.html",
    "sidebar.html",
    "vertical-header.html",
  ];
  const patternsFiles = [
    "comments.php",
    "footer-centered.php",
    "footer-columns.php",
    "footer-newsletter.php",
    "footer-social.php",
    "footer.php",
    "header-centered.php",
    "header-columns.php",
    "header-large-title.php",
    "header.php",
    "hidden-404.php",
    "hidden-blog-heading.php",
    "hidden-search.php",
    "hidden-sidebar.php",
    "hidden-written-by.php",
    "more-posts.php",
    "post-navigation.php",
    "template-query-loop.php",
  ];
  const templatesFiles = [
    "404.html",
    "archive.html",
    "home.html",
    "index.html",
    "page-no-title.html",
    "page.html",
    "search.html",
    "single.html",
  ];
  const configFiles = ["php.ini"];
  const nginxFiles = ["nginx.conf"];
  const scriptsFiles = ["check-docker.js"];

  // Start
  console.log("\n");
  console.log(
    "📦 ",
    bgYellow(` Installing WordPressify files in: → ${bgGreen(` ${theDir} `)}\n`),
    dim(`\n In the directory: ${theCWD}\n`),
  );

  const spinner = ora({ text: "" });
  spinner.start(`1. Creating WordPressify files inside → ${bgWhite(` ${theDir} `)}`);

  // Copy files from package
  const copyFiles = () => {
    for (const relativePath of filesToCopy) {
      const source = path.join(repoRoot, relativePath);
      let basename = path.basename(relativePath);
      // Strip leading dot to match the rename logic that adds it back
      if (basename.startsWith(".")) {
        basename = basename.slice(1);
      }
      fs.copyFileSync(source, path.join(theCWD, basename));
    }
  };

  try {
    copyFiles();
  } catch (err) {
    handleError(err);
  }

  (async () => {
    if (!fs.existsSync("src")) {
      const dirs = [
        "scripts",
        "config/nginx",
        "src/assets/css/parts",
        "src/assets/css/patterns",
        "src/assets/fonts/inter",
        "src/assets/fonts/fira-code",
        "src/assets/img",
        "src/assets/js",
        "src/plugins",
        "src/theme/parts",
        "src/theme/patterns",
        "src/theme/templates",
      ];
      dirs.forEach((dir) => fs.mkdirSync(dir, { recursive: true }));
    }

    dotFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x.slice(1)}`, `${theCWD}/${x}`, (err) => handleError(err)),
    );
    cssFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/css/${x}`, (err) => handleError(err)),
    );
    interFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/fonts/inter/${x}`, (err) =>
        handleError(err),
      ),
    );
    firaCodeFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/fonts/fira-code/${x}`, (err) =>
        handleError(err),
      ),
    );
    imgFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/img/${x}`, (err) => handleError(err)),
    );
    jsFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/assets/js/${x}`, (err) => handleError(err)),
    );
    themeFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/${x}`, (err) => handleError(err)),
    );
    partsFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/parts/${x}`, (err) => handleError(err)),
    );
    patternsFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/patterns/${x}`, (err) =>
        handleError(err),
      ),
    );
    templatesFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/src/theme/templates/${x}`, (err) =>
        handleError(err),
      ),
    );
    configFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/config/${x}`, (err) => handleError(err)),
    );
    nginxFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/config/nginx/${x}`, (err) => handleError(err)),
    );
    scriptsFiles.map((x) =>
      fs.renameSync(`${theCWD}/${x}`, `${theCWD}/scripts/${x}`, (err) => handleError(err)),
    );
    spinner.succeed();

    spinner.start("2. WordPressify is ready to go ⚡");
    spinner.succeed();

    // Done
    printNextSteps();
  })();
};

export { run };
