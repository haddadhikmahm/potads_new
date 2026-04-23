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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                potads: {
                    'blue-dark': '#0A2647',
                    'blue': '#144272',
                    'blue-light': '#205295',
                    'yellow': '#F9D949',
                    'yellow-dark': '#F4CE14',
                },
            },
        },
    },

    plugins: [forms],
};
