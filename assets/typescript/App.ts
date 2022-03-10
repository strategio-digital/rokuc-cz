/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import Alpine from "../../vendor/strategio/contentio-sdk/assets/typescript/Plugins/Alpine";
import FormValidator from "../../vendor/strategio/contentio-sdk/assets/typescript/Utils/FormValidator";
import Measurement from "../../vendor/strategio/contentio-sdk/assets/typescript/Components/Measurement";
import SubscribeForm from "../../vendor/strategio/contentio-sdk/assets/typescript/Components/SubscribeForm";
import ContactForm from "../../vendor/strategio/contentio-sdk/assets/typescript/Components/ContactForm";
import VideoSlider from "./components/VideoSlider";
import SmoothScroll from "./components/SmoothScroll";

import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'

(() => {
    // Alpine
    Alpine();

    // GTM
    Measurement();

    // Slider
    VideoSlider();

    // Scroll
    SmoothScroll();

    // Light gallery
    (Array.from(document.querySelectorAll('[data-gallery-container]')) as HTMLElement[]).forEach(node => {
        lightGallery(node, {
            plugins: [lgThumbnail],
            licenseKey: 'your_license_key',
            speed: 300,
        });
    })

    // Form validator
    const formValidator = FormValidator({
        errorClasses: 'pr-10 border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500',
        neutralClasses: 'border-gray-300 text-gray-900 placeholder-gray-300 focus:ring-indigo-500 focus:border-indigo-500',
        alertSuccessBg: 'flex items-center text-white text-bold text-sm p-3 rounded bg-green-700',
        alertErrorBg: 'flex items-center text-white text-bold text-sm p-3 rounded bg-rose-700',
        alertIcon: '<svg class="mr-2 inline-block max-w-[40px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        hiddenClass: 'hidden',
        antispamMessage: 'Vyčkejte 15 vteřin a odešlete zprávu znovu. Tímto se bráníme proti spamu, děkujeme za pochopení.',
        antispamDelay: 15 * 1000
    });

    // Subscribe Form
    SubscribeForm(formValidator, document.getElementById('subscribeForm') as HTMLFormElement | null, [
        {
            name: 'email',
            rules: [
                {type: 'required', message: 'E-mail je povinný.'},
                {type: 'max', message: 'Maximální délka e-mailu je 100 znaků.', param: {max: 50}},
                {type: 'email', message: 'E-mail musí být v platném formátu.'},
            ]
        }
    ]);

    // ContactForm
    ContactForm(formValidator, document.getElementById('contactForm') as HTMLFormElement, [
        {
            name: 'name',
            rules: [
                {type: 'min', message: 'Jméno musí obsahovat alespoň 3 znaky.', param: {min: 3}},
                {type: 'max', message: 'Jméno může obsahovat maximálně 50 znaků.', param: {max: 50}},
            ],
        },
        {
            name: 'email',
            rules: [
                {type: 'required', message: 'E-mail je povinný.'},
                {type: 'max', message: 'Maximální délka e-mailu je 100 znaků.', param: {max: 50}},
                {type: 'email', message: 'E-mail musí být v platném formátu.'},
            ]
        },
        {
            name: 'phone',
            rules: [
                {type: 'required', message: 'Telefonní číslo je povinné.'},
                {type: 'phone', message: 'Telefonní číslo musí být v platném formátu.'},
                {type: 'min', message: 'Telefonní číslo musí obsahovat alespoň 9 znaků.', param: {min: 9}},
                {type: 'max', message: 'Telefonní číslo může obsahovat maximálně 50 znaků.', param: {max: 50}}
            ]
        },
        {
            name: 'message',
            rules: [
                {type: 'required', message: 'Zpráva je povinná.'}
            ]
        }
    ]);
})();