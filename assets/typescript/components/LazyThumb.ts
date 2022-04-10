/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import Axios from "../../../vendor/strategio/contentio-sdk/assets/typescript/Plugins/Axios"

export default () => {

    const createUrl = (filePath: string, params: string) => {
        const extension = '.' + filePath.split('.').pop(); // with dot
        const basename = filePath.split('/').pop()?.split('.')[0];
        const path = filePath.replace(basename + extension, '');

        const data = JSON.parse(params);
        const suffix = '--' + data.method.toUpperCase() + '-' + data.quality + '-' + (data.size.width ?? '') + 'x' + (data.size.height ?? '');

        // DEV
        //return 'https://dev-contentio-app.s3.eu-west-1.amazonaws.com/_develop_contentio_app/article/1/test--EXACT-80-200x200.jpg';
        //return 'https://cdn.contentio.dev/_develop_contentio_app/article/1/test--EXACT-80-200x200.jpg';
        //return 'https://dg8jgypxflvcm.cloudfront.net/_develop_contentio_app/article/1/test--EXACT-80-200x200.jpg';

        // PROD
        //return 'https://contentio-app.s3.eu-west-1.amazonaws.com/prod_rokuc_cz/article/9/03-Zjistovani-vlhkosti-v-plochych-strechach.png';
        //return 'https://cdn.contentio.app/prod_rokuc_cz/article/9/03-Zjistovani-vlhkosti-v-plochych-strechach.png';
        //return 'https://d13wjlmuheewzx.cloudfront.net/prod_rokuc_cz/article/9/03-Zjistovani-vlhkosti-v-plochych-strechach.png';

        return process.env.CDN_ENDPOINT + path + basename + suffix + extension;
    }

    document.querySelectorAll('[data-img-path]').forEach(async node => {

        // Todo: loading icon
        // Todo: not found icon
        const image = node as HTMLImageElement;

        if (image.dataset.imgPath && image.dataset.imgParams) {
            let cdnResponse = null;

            try {
                const url = createUrl(image.dataset.imgPath, image.dataset.imgParams);
                cdnResponse = await Axios.get(url, {responseType: 'blob'});

                const reader = new FileReader();
                reader.readAsDataURL(cdnResponse.data);
                reader.onload = () => image.src = reader.result as string;

            } catch (error: any) {
                cdnResponse = error.response;
            }

            if (cdnResponse.status === 403) {
                const params = JSON.parse(image.dataset.imgParams);
                const apiResponse = await Axios.post('image/create', {path: image.dataset.imgPath, ...params});
                image.src = apiResponse.data.base64;
            }
        }
    });
}