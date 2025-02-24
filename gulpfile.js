import pkg from "gulp";
import babel from "gulp-babel";
import browserSync from "browser-sync";
import concat from "gulp-concat";
import { deleteAsync } from "del";
import log from "fancy-log";
import fs from "fs";
import partialimport from "postcss-easy-import";
import plumber from "gulp-plumber";
import postcss from "gulp-postcss";
import postCSSMixins from "postcss-mixins";
import autoprefixer from "autoprefixer";
import postcssPresetEnv from "postcss-preset-env";
import sourcemaps from "gulp-sourcemaps";
import uglify from "gulp-uglify";
import zip from "gulp-vinyl-zip";
import cleanCSS from "gulp-clean-css";

const { series, dest, src, watch } = pkg;

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */
const themeName = process.env.THEME_NAME || "wordpressify";

/* -------------------------------------------------------------------------------------------------
PostCSS Plugins
-------------------------------------------------------------------------------------------------- */
const pluginsListDev = [
  partialimport,
  postcssPresetEnv({
    stage: 0,
    features: {
      "nesting-rules": true,
      "custom-media-queries": true,
    },
  }),
  postCSSMixins,
  autoprefixer,
];

const pluginsListProd = [
  partialimport,
  postcssPresetEnv({
    stage: 0,
    features: {
      "nesting-rules": true,
      "custom-media-queries": true,
    },
  }),
  postCSSMixins,
  autoprefixer,
];

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Bundles
-------------------------------------------------------------------------------------------------- */
const headerJS = ["./node_modules/jquery/dist/jquery.js"];
const footerJS = ["./src/assets/js/**"];

/* -------------------------------------------------------------------------------------------------
Environment Tasks
-------------------------------------------------------------------------------------------------- */

function registerCleanup(done) {
  process.on("SIGINT", () => {
    process.exit(0);
  });
  done();
}

/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */
function devServer() {
  const portnumber = parseInt(process.env.PROXY_PORT) || 3010;

  browserSync({
    logPrefix: "🐳 WordPressify",
    proxy: {
      target: "webserver:8080",
      proxyReq: [
        function (proxyReq, req) {
          proxyReq.setHeader("Host", req.headers.host);
        },
      ],
    },
    host: "localhost",
    port: portnumber,
    notify: false,
    open: false,
    logConnections: true,
  });

  const watchOptions = {
    usePolling: true,
    interval: 1000,
  };

  const watcherCSS = watch(["./src/assets/css/**/*.css", "!./**/.DS_Store"], watchOptions);
  const watcherJs = watch(["./src/assets/js/**", "!./**/.DS_Store"], watchOptions);
  const watcherImg = watch(["./src/assets/img/**", "!./**/.DS_Store"], watchOptions);
  const watcherFonts = watch(["./src/assets/fonts/**", "!./**/.DS_Store"], watchOptions);
  const watcherTheme = watch(["./src/theme/**", "!./**/.DS_Store"], watchOptions);
  const watcherPlugins = watch(["./src/plugins/**", "!./**/.DS_Store"], watchOptions);

  watcherCSS.on("all", function (event, path) {
    console.log(`${wpFy} - CSS Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    stylesDev();
  });

  watcherJs.on("all", function (event, path) {
    console.log(`${wpFy} - JS Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    footerScriptsDev();
    Reload();
  });

  watcherImg.on("all", function (event, path) {
    console.log(`${wpFy} - IMG Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    copyImagesDev();
    Reload();
  });

  watcherImg.on("unlink", async function (path) {
    await deleteFiles(path, "isAssets");
  });

  watcherFonts.on("all", function (event, path) {
    console.log(`${wpFy} - Fonts Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    copyFontsDev();
    Reload();
  });

  watcherFonts.on("unlink", async function (path) {
    await deleteFiles(path, "isAssets");
  });

  watcherTheme.on("all", function (event, path) {
    console.log(`${wpFy} - Theme Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    copyThemeDev();
    Reload();
  });

  watcherTheme.on("unlink", async function (path) {
    await deleteFiles(path);
  });

  watcherPlugins.on("all", function (event, path) {
    console.log(`${wpFy} - Plugins Watcher Event "${event}" triggered for file "${path}" ⚙️`);
    pluginsDev();
    Reload();
  });
}

async function deleteFiles(path, isAassets) {
  console.log(`${wpFy} - File ${path} was removed!`);
  let pathName;
  if (isAassets) {
    pathName = path.replace("src/assets/", "");
  } else {
    pathName = path.replace("src/theme/", "");
  }
  console.log("Deleting: " + pathName + " 🚫");
  await deleteAsync("./build/wordpress/wp-content/themes/" + themeName + "/" + pathName);
}

async function cleanTheme() {
  await deleteAsync("./build/wordpress/wp-content/themes/" + themeName);
}

function Reload() {
  browserSync.reload();
}

function copyThemeDev() {
  if (!fs.existsSync("./build")) {
    log(buildNotFound);
    process.exit(1);
  } else {
    return src("./src/theme/**", { encoding: false }).pipe(
      dest("./build/wordpress/wp-content/themes/" + themeName),
    );
  }
}

function copyImagesDev() {
  return src("./src/assets/img/**", { encoding: false }).pipe(
    dest("./build/wordpress/wp-content/themes/" + themeName + "/img"),
  );
}

function copyFontsDev() {
  return src("./src/assets/fonts/**", { encoding: false }).pipe(
    dest("./build/wordpress/wp-content/themes/" + themeName + "/fonts"),
  );
}

function stylesDev() {
  return src("./src/assets/css/style.css")
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(postcss(pluginsListDev))
    .pipe(sourcemaps.write("."))
    .pipe(dest("./build/wordpress/wp-content/themes/" + themeName))
    .pipe(browserSync.stream({ match: "**/*.css" }));
}

function headerScriptsDev() {
  return src(headerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(concat("header-bundle.js"))
    .pipe(sourcemaps.write("."))
    .pipe(dest("./build/wordpress/wp-content/themes/" + themeName + "/js"));
}

function footerScriptsDev() {
  return src(footerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ["@babel/preset-env"],
      }),
    )
    .pipe(concat("footer-bundle.js"))
    .pipe(sourcemaps.write("."))
    .pipe(dest("./build/wordpress/wp-content/themes/" + themeName + "/js"));
}

function pluginsDev() {
  return src(["./src/plugins/**", "!./src/plugins/README.md"], {
    encoding: false,
  }).pipe(dest("./build/wordpress/wp-content/plugins"));
}

const dev = series(
  registerCleanup,
  cleanTheme,
  copyThemeDev,
  copyImagesDev,
  copyFontsDev,
  stylesDev,
  headerScriptsDev,
  footerScriptsDev,
  pluginsDev,
  devServer,
);
dev.displayName = "dev";

export { dev };

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */
async function cleanProd() {
  await deleteAsync(["./dist/*"]);
}

function copyThemeProd() {
  return src(["./src/theme/**", "!./src/theme/**/node_modules/**"], {
    encoding: false,
  }).pipe(dest("./dist/themes/" + themeName));
}

function copyFontsProd() {
  return src("./src/assets/fonts/**", { encoding: false }).pipe(
    dest("./dist/themes/" + themeName + "/fonts"),
  );
}

function stylesProd() {
  return src("./src/assets/css/style.css")
    .pipe(plumber({ errorHandler: onError }))
    .pipe(postcss(pluginsListProd))
    .pipe(cleanCSS())
    .pipe(dest("./dist/themes/" + themeName));
}

function headerScriptsProd() {
  return src(headerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(concat("header-bundle.js"))
    .pipe(uglify())
    .pipe(dest("./dist/themes/" + themeName + "/js"));
}

function footerScriptsProd() {
  return src(footerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      babel({
        presets: ["@babel/preset-env"],
      }),
    )
    .pipe(concat("footer-bundle.js"))
    .pipe(uglify())
    .pipe(dest("./dist/themes/" + themeName + "/js"));
}

function pluginsProd() {
  return src(["./src/plugins/**", "!./src/plugins/**/*.md"], {
    encoding: false,
  }).pipe(dest("./dist/plugins"));
}

function processImages() {
  return src("./src/assets/img/**", { encoding: false })
    .pipe(plumber({ errorHandler: onError }))
    .pipe(dest("./dist/themes/" + themeName + "/img"));
}

function zipProd() {
  return src("./dist/themes/" + themeName + "/**/*", { encoding: false })
    .pipe(zip.dest("./dist/" + themeName + ".zip"))
    .on("end", () => {
      log(pluginsGenerated);
      log(filesGenerated);
      log(thankYou);
    });
}

const prod = series(
  cleanProd,
  copyThemeProd,
  copyFontsProd,
  stylesProd,
  headerScriptsProd,
  footerScriptsProd,
  pluginsProd,
  processImages,
  zipProd,
);
prod.displayName = "prod";
export { prod };

/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */
const onError = (err) => {
  log(wpFy + " - " + errorMsg + " " + err.toString());
};

function Backup() {
  if (!fs.existsSync("./build")) {
    log(buildNotFound);
    process.exit(1);
  } else {
    return src("./build/**/*")
      .pipe(zip.dest("./backups/" + date + ".zip"))
      .on("end", () => {
        log(backupsGenerated);
        log(thankYou);
      });
  }
}

Backup.displayName = "backup";
export { Backup };

/* -------------------------------------------------------------------------------------------------
Messages
-------------------------------------------------------------------------------------------------- */
const date = new Date().toLocaleDateString("en-GB").replace(/\//g, ".");
const errorMsg = "\x1b[41mError\x1b[0m";
const buildNotFound =
  errorMsg +
  " ⚠️　- You need to build the project first. Run the command: $ \x1b[1mdocker compose build\x1b[0m";
const filesGenerated =
  "Your ZIP template file was generated in: \x1b[1m" + "/dist/" + themeName + ".zip\x1b[0m - ✅";
const pluginsGenerated = "Plugins are generated in: \x1b[1m" + "/dist/plugins/\x1b[0m - ✅";
const backupsGenerated =
  "Your backup was generated in: \x1b[1m" + "/backups/" + date + ".zip\x1b[0m - ✅";
const wpFy = "\x1b[42m\x1b[1mWordPressify\x1b[0m";
const wpFyUrl = "\x1b[2m - https://www.wordpressify.co/\x1b[0m";
const thankYou = "Thank you for using " + wpFy + wpFyUrl;

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */
