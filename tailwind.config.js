/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.ts",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        fontFamily: {
            'Robot': ['Roboto', 'Arial', 'sans-serif']
        }
    },
    plugins: [],
}

