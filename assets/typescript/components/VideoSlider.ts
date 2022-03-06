/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import {tns} from "tiny-slider";

export default () => {
    if (document.getElementById('videoSlider')) {
        tns({
            items: 1,
            container: '#videoSlider',
            prevButton: '#videoSlider-prev',
            nextButton: '#videoSlider-next',
            nav: false
        });
    }
}