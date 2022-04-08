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

        return process.env.CDN_ENDPOINT + path + basename + suffix + extension;
    }

    document.querySelectorAll('[data-img-path]').forEach(async node => {
        const image = node as HTMLImageElement;

        if (image.dataset.imgPath && image.dataset.imgParams) {
            const params = JSON.parse(image.dataset.imgParams);
            const url = createUrl(image.dataset.imgPath, image.dataset.imgParams);

            try {
                // Todo: fix cors
                const cdnResponse = await Axios.get(url, {responseType: 'blob' });
                if (cdnResponse.status === 200) {
                    const reader = new FileReader();
                    reader.readAsDataURL(cdnResponse.data);
                    reader.onload = () => {
                        image.src = reader.result as string;
                    };
                }

                return 1;
            } catch (e) {}

            try {
                const apiResponse = await Axios.post('image/create', {path: image.dataset.imgPath, ...params});
                image.src = apiResponse.data.base64;
            } catch (e: any) {
                console.error(node, e.response.data.messages);
            }
        }
    });
}