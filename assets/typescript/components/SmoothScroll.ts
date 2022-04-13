/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

export default () => {
    Array.from(document.querySelectorAll('[data-smooth-scroll]')).forEach(node => node.addEventListener('click', (event) => {
        const href = node.getAttribute('href') as string;

        if (!href.includes('#') || href === '#') {
            return 0;
        }

        event.preventDefault();
        const offsetTop = (document.querySelector(href) as HTMLElement).offsetTop;
        const topNavbar = document.getElementById('topNavbar') as HTMLDivElement;

        scroll({
            top: offsetTop - topNavbar.clientHeight,
            behavior: 'smooth',
        });
    }));
}