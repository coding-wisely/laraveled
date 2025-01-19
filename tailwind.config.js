import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'selector',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/livewire/flux-pro/stubs/**/*.blade.php',
        './vendor/livewire/flux/stubs/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                abel: ['Abel', 'cursive'],
            },
            colors: {
                laravel: {
                    50: '#FFE5E3',  // Lightest shade
                    100: '#FFC9C5', // Very light shade
                    200: '#FFAFA9', // Lighter shade
                    300: '#FF9389', // Light-mid shade
                    400: '#FF776B', // Slightly darker
                    500: '#FF2D20', // Default primary color
                    600: '#E6291D', // Darker shade
                    700: '#CC2519', // Even darker
                    800: '#B32216', // Darker still
                    900: '#991D12', // Darkest shade
                },
                // Accent variables are defined in resources/css/app.css...
                accent: {
                    DEFAULT: 'var(--color-accent)',
                    content: 'var(--color-accent-content)',
                    foreground: 'var(--color-accent-foreground)',
                },
            },
        },
    },
    plugins: [forms],
};
