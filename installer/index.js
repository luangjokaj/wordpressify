#!/usr/bin/env node
import readline from "readline";
import { Command } from "commander";
import { createRequire } from "module";
import { run } from "./modules/run.js";
import { red, green, bgGreen } from "./modules/colors.js";

const program = new Command();

const require = createRequire(import.meta.url);
const packageData = require("./package.json");

const version = packageData.version;
const currentNodeVersion = process.versions.node;
const semver = currentNodeVersion.split(".");
const major = semver[0];

program
  .version(version, "-v, --vers", "output the current version")
  .option("-y, --non-interactive", "do not prompt for user input")
  .parse(process.argv);

const confirm = (message) =>
  new Promise((resolve) => {
    const rl = readline.createInterface({
      input: process.stdin,
      output: process.stdout,
    });
    rl.question(`${message} (y/N) `, (answer) => {
      rl.close();
      resolve(answer.toLowerCase() === "y");
    });
  });

(async () => {
  let confirmed = false;
  if (program.opts().nonInteractive) {
    confirmed = true;
  } else {
    confirmed = await confirm(
      `Do you want to install ${bgGreen(" WordPressify ")} in the current directory?\n${red(process.cwd())}`,
    );
  }

  if (confirmed) {
    // If below Node 12
    if (12 > major) {
      console.error(
        red(
          "You are running Node " +
            currentNodeVersion +
            ".\n" +
            "Install WordPressify requires Node 12 or higher. \n" +
            "Kindly, update your version of Node.",
        ),
      );
      process.exit(1);
    }

    // Makes the script crash on unhandled rejections instead of silently
    // ignoring them. In the future, promise rejections that are not handled will
    // terminate the Node.js process with a non-zero exit code
    process.on("unhandledRejection", (err) => {
      throw err;
    });

    /**
     * Run the entire program
     *
     * Runs all the functions with async/await
     */
    run();
  }
})();
