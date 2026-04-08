#!/usr/bin/env node
import { execSync } from "child_process";

const red = (s) => `\x1b[31m${s}\x1b[0m`;
const bold = (s) => `\x1b[1m${s}\x1b[0m`;
const dim = (s) => `\x1b[2m${s}\x1b[0m`;

try {
  execSync("docker info", { stdio: "ignore" });
} catch {
  console.log(`\n${bold(red("Error: Docker is not running."))}`);
  console.log(`\n  ${dim("Please start Docker and try again.")}`);
  console.log(`  ${dim("https://docs.docker.com/get-docker/")}\n`);
  process.exit(1);
}
