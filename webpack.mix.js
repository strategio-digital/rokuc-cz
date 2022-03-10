/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

const laravelMix = require('laravel-mix');
const contentioMix = require('./vendor/strategio/contentio-sdk/mix.config');
const mix = contentioMix(laravelMix, true);

mix.copyDirectory('node_modules/lightgallery/fonts/*', 'www/temp/static/font');
mix.copyDirectory('node_modules/lightgallery/images/*', 'www/temp/static/img');