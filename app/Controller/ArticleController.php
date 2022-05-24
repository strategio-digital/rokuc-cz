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

class ArticleController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/article-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('article_detail', 'POST', "article/show-one", [
            'json' => [
                'slug' => $slug,
                'suppressLabels' => true,
                'suppressFiles' => true,
                'suppressParagraphs' => false,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
        
        $responses = $this->dispatchRequests('Article detail');
        $response = $responses['article_detail'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
}