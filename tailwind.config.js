/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        st: "#fff02a",
        nd : "#1b1b1b",
      },
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
    },
  },
  darkMode: 'class',
  plugins: [],
}
