import { dim, red, green, yellow, cyan, gray, bgGreen, bgYellow, bgWhite } from "./colors.js";

const printNextSteps = () => {
  console.log("\n\n✅ ", bgGreen(" All done! Happy coding. \n"));
  console.log(
    "Installer has added WordPressify files to the current directory.  ",
    "\nInside this directory, you can run this command:",
  );

  // Scripts
  console.log(
    "\n👉 ",
    " Type",
    bgWhite(" npm run dev "),
    "\n\n",
    "	Use to compile and run your files.",
    "\n",
    "	Watches for any changes and reports back any errors in your code.",
  );

  // Support
  console.log("\n✊ ", bgYellow(" Support WordPressify \n"));
  console.log("Like WordPressify? Check out our other free and open source repositories: \n");
  console.log(
    `	${yellow("Cherry → ")} https://cherry.design/?ref=wordpressify-cli`,
    "\n",
    `	${gray("• A design system to build the web.")}`,
    "\n",
    `	${cyan("Doccupine → ")} https://doccupine.com/?ref=wordpressify-cli`,
    "\n",
    `	${gray("• Beautiful documentation websites from MDX.")}`,
    "\n",
    `	${green("Powered by Riangle → ")} https://riangle.com/?ref=wordpressify-cli`,
    "\n",
    "\n",
    `	${red("Thank you for using WordPressify → ")} https://wordpressify.co`,
  );

  // Get started
  console.log("\n\n🎯 ", bgGreen(" Get Started → \n"));
  console.log(" You can start: \n");
  console.log(
    ` ${dim("1.")} Rename: ${green(".env_example")} to ${green(".env")}`,
  );
  console.log(
    `	${dim("Set your new theme directory name:")} ${green(
      "THEME_NAME=",
    )}${red("wordpressify")} `,
    "\n",
  );
  console.log(
    ` ${dim("2.")} Run: ${green("npm")} run start  ${dim(
      "or",
    )}  ${green("docker")} compose up`,
    "\n",
    `	${dim("Make sure")} ${red("Docker")} ${green("is running")}`,
    "\n\n",
  );
  process.exit();
};

export { printNextSteps };
