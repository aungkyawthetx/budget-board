/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.php",
    "./src/**/*.php",
    "./views/**/*.php",
    "./config/**/*.php",
    "./**/*.php" // Scan all PHP files
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}