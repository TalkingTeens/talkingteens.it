/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                st: "#fff02a",
                nd: "#1b1b1b",
            },
            scale: {
                98: "0.98",
                102: "1.02",
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            animation: {
                marquee: "marquee 35s linear infinite",
            },
            keyframes: {
                marquee: {
                    from: {transform: "translateX(0)"},
                    to: {transform: "translateX(-100%)"},
                },
            },
        },
    },
    darkMode: "class",
    plugins: [
        require('@tailwindcss/typography'),
        "prettier-plugin-tailwindcss"
    ],
};
