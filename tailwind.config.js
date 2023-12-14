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
                "infinite-scroll": "infinite-scroll 35s linear infinite",
                slide: "slide 2.5s linear infinite",
            },
            keyframes: {
                "infinite-scroll": {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(-100%)" },
                },
                slide: {
                    "0%": { transform: "translateY(100%)", opacity: 0.1 },
                    "15%": { transform: "translateY(0)", opacity: 1 },
                    "30%": { transform: "translateY(0)", opacity: 1 },
                    "45%": { transform: "translateY(-100%)", opacity: 1 },
                    "100%": { transform: "translateY(-100%)", opacity: 0.1 },
                },
            },
        },
    },
    darkMode: "class",
    plugins: ["prettier-plugin-tailwindcss"],
};
