#!/usr/bin/env node
import readline from "readline";
import { Command } from "commander";
import { createRequire } from "module";
import { run } from "./modules/run.js";
import { update } from "./modules/update.js";
import { red, bgGreen } from "./modules/colors.js";

const require = createRequire(import.meta.url);
const packageData = require("./package.json");

const version = packageData.version;
const currentNodeVersion = process.versions.node;
const semver = currentNodeVersion.split(".");
const major = semver[0];

// If below Node 12
if (12 > major) {
  console.error(
    red(
      "You are running Node " +
        currentNodeVersion +
        ".\n" +
        "WordPressify requires Node 12 or higher. \n" +
        "Kindly, update your version of Node.",
    ),
  );
  process.exit(1);
}

process.on("unhandledRejection", (err) => {
  throw err;
});

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

const program = new Command();

program
  .version(version, "-v, --vers", "output the current version")
  .enablePositionalOptions()
  .passThroughOptions();

program
  .command("install", { isDefault: true })
  .description("Install WordPressify in the current directory")
  .option("-y, --non-interactive", "do not prompt for user input")
  .action(async (options) => {
    let confirmed = false;
    if (options.nonInteractive) {
      confirmed = true;
    } else {
      confirmed = await confirm(
        `Do you want to install ${bgGreen(" WordPressify ")} in the current directory?\n${red(process.cwd())}`,
      );
    }

    if (confirmed) {
      run();
    }
  });

program
  .command("update")
  .description("Update core WordPressify files (Docker, build, configs)")
  .option("-y, --non-interactive", "do not prompt for user input")
  .action(async (options) => {
    let confirmed = false;
    if (options.nonInteractive) {
      confirmed = true;
    } else {
      confirmed = await confirm(
        `Do you want to update ${bgGreen(" WordPressify ")} core files in the current directory?\n${red(process.cwd())}`,
      );
    }

    if (confirmed) {
      update();
    }
  });

program.parse(process.argv);
