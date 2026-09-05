/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('daisyui'),
    ],
    daisyui: {
        themes: [
            {
                craveat: {
                    "primary": "#9155fd",      // Bright purple from the image
                    "primary-content": "#ffffff",
                    "secondary": "#ff4c51",    // Pinkish/Red secondary
                    "secondary-content": "#ffffff",
                    "accent": "#d8b4fe",
                    "neutral": "#2a2e37",
                    "base-100": "#312d4b",     // Card and Sidebar Background
                    "base-200": "#28243d",     // Main App Background
                    "base-300": "#1f1b2e",     // Deeper elements
                    "base-content": "#e7e3fc", // Light gray/white text
                    "info": "#3abff8",
                    "success": "#56ca00",      // Neon green for success/delivered
                    "warning": "#ffb400",      // Yellow
                    "error": "#ff4c51",        // Neon red for cancelled
                },
            },
        ],
        darkTheme: 'craveat',
        base: true,
        styled: true,
        utils: true,
        prefix: '',
        logs: true,
        themeRoot: ':root',
    },
};
