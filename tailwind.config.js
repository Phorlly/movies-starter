/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#3490dc",
                secondary: "#e74c3c",
            },
            fontFamily: {
                sans: ["Inter", "system-ui", "Arial", "sans-serif"],
            },
            width: {
                "1/2": "50%",
                "1/3": "33.33%",
                "2/3": "66.66%",
                "1/4": "25%",
                "3/4": "75%",
                "1/5": "20%",
                "2/5": "40%",
                "3/5": "60%",
                '96': '24rem',
            },
        },
        spinner: (theme) => ({
            default: {
                border: '2px',
                size: '1rem',
                speed: '500ms',
                color: '#dae1e7',
                'border-color': theme('colors.primary'),
                'border-width': '4px',
                'border-radius': '50%',
                'animation': 'dots 2s linear infinite',
            }
        }),
    },
    plugins: [
        require('tailwindcss-spinner')(),
    ],
}

