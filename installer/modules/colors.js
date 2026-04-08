/**
 * ANSI color helpers — zero dependencies.
 */

const esc = (code) => (s) => `\x1b[${code}m${s}\x1b[0m`;

export const bold = esc("1");
export const dim = esc("2");
export const red = esc("31");
export const green = esc("32");
export const yellow = esc("33");
export const cyan = esc("36");
export const gray = esc("90");
export const bgGreen = (s) => `\x1b[30;42m${s}\x1b[0m`;
export const bgYellow = (s) => `\x1b[30;43m${s}\x1b[0m`;
export const bgWhite = (s) => `\x1b[30;47m${s}\x1b[0m`;
