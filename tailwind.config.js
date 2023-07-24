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
      scale: {
        '98': '0.98',
        '102': '1.02',
      },
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
    },
  },
  darkMode: 'class',
  plugins: [],
}
