/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

const contentioTheme = require('./vendor/strategio/contentio-sdk/tailwind.config');

module.exports = {
    ...contentioTheme,
    content: [
        ...contentioTheme.content,
        __dirname + './assets/**/*.css',
        __dirname + './view/**/*.latte',
    ]
}