import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                grandstander: ['Grandstander', 'cursive'], // Define Grandstander as a font-family
                telescope: ['"Annie Use Your Telescope"', 'cursive'], // Add font-family here
            },
        },
    },

    plugins: [forms],
};
