<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends BaseController
{
    const ARTICLE_LABEL = 'sluzby';
    
    #[Template(path: __DIR__ . '/../../view/controller/service-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('service_detail', 'POST', "article/show-one", [
            'json' => [
                'slug' => $slug,
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => false,
                'suppressParagraphFiles' => false,
                'suppressPrevNext' => false,
                'suppressPrevNextFiles' => false,
                'prevNextByLabel' => self::ARTICLE_LABEL
            ]
        ]);
    
        $responses = $this->dispatchRequests('Služby Detail');
        $response = $responses['service_detail'];
        $contents = $response->getBody()->getContents();
    
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
    
        $this->template->data = json_decode($contents, true);
    }
}