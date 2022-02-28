/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

const laravelMix = require('laravel-mix');
const contentioMix = require('./vendor/strategio/contentio-sdk/mix.config');
contentioMix(laravelMix, true)