import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import ora from "ora";
import { dim, green, red, bgGreen, bgYellow } from "./colors.js";
import { clearConsole } from "./clearConsole.js";

const repoRoot = path.resolve(
  path.dirname(fileURLToPath(import.meta.url)),
  "..",
  "..",
);

const theCWD = process.cwd();

const coreFiles = [
  // Docker
  "docker-compose.yml",
  "Dockerfile-nodejs",
  "Dockerfile-wordpress",
  // Build
  "gulpfile.js",
  ".babelrc",
  // Config
  "config/php.ini",
  "config/nginx/nginx.conf",
  ".env_example",
  // Linting / formatting
  ".stylelintrc",
  ".prettierrc",
  ".php-cs-fixer.php",
  ".editorconfig",
  ".dockerignore",
  // Scripts
  "check-docker.js",
];

const update = () => {
  clearConsole();

  // Validate this is a WordPressify project
  const userPkgPath = path.join(theCWD, "package.json");
  if (!fs.existsSync(userPkgPath)) {
    console.error(
      red(
        "\n No package.json found in the current directory.\n" +
          " Make sure you are running this command from a WordPressify project.\n",
      ),
    );
    process.exit(1);
  }

  console.log("\n");
  console.log(
    "🔄 ",
    bgYellow(
      ` Updating WordPressify core files in: → ${bgGreen(` ${path.basename(theCWD)} `)}\n`,
    ),
    dim(`\n In the directory: ${theCWD}\n`),
  );

  // Show files that will be updated
  console.log(dim(" The following files will be overwritten:\n"));
  for (const file of coreFiles) {
    console.log(`   ${dim("•")} ${file}`);
  }
  console.log(`   ${dim("•")} package.json ${dim("(scripts only)")}`);
  console.log();

  const spinner = ora({ text: "" });
  spinner.start("Updating core files");

  try {
    for (const relativePath of coreFiles) {
      const source = path.join(repoRoot, relativePath);
      const dest = path.join(theCWD, relativePath);
      fs.mkdirSync(path.dirname(dest), { recursive: true });
      fs.copyFileSync(source, dest);
    }
  } catch (err) {
    spinner.fail("Failed to update core files");
    console.error(red(err.message));
    process.exit(1);
  }

  spinner.succeed(`Updated ${coreFiles.length} core files`);

  // Merge package.json scripts
  spinner.start("Updating package.json scripts");

  try {
    const userPkg = JSON.parse(fs.readFileSync(userPkgPath, "utf8"));
    const sourcePkg = JSON.parse(
      fs.readFileSync(path.join(repoRoot, "installer/package.json"), "utf8"),
    );

    userPkg.scripts = sourcePkg.scripts;

    fs.writeFileSync(userPkgPath, JSON.stringify(userPkg, null, 2) + "\n");
  } catch (err) {
    spinner.fail("Failed to update package.json scripts");
    console.error(red(err.message));
    process.exit(1);
  }

  spinner.succeed("Updated package.json scripts");

  // Done
  console.log(
    "\n✅ ",
    bgGreen(" WordPressify core files are up to date! \n"),
  );
  console.log(
    dim(" Your"),
    green("src/"),
    dim("folder and dependencies were not modified.\n"),
  );

  process.exit();
};

export { update };
