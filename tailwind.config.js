/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

const contentioTheme = require('./vendor/strategio/contentio-sdk/tailwind.config');

module.exports = {
    ...contentioTheme,
    content: [
        ...contentioTheme.content,
        __dirname + '/assets/**/*.ts',
        __dirname + '/assets/**/*.css',
        __dirname + '/view/**/*.latte',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Ubuntu', 'sans-serif'],
                serif: ['Playfair Display', 'serif'],
            },
            colors: {
                gold: {
                    light: '#c0b596',
                    dark: '#b6a268'
                },
                blue: {
                    'dark': '#272c3f',
                    'extra-dark': '#212636',
                    'light': '#41485f',
                }
            }
        }
    }
}