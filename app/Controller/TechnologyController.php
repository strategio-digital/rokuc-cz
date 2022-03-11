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

class TechnologyController extends BaseController
{
    const ARTICLE_LABEL = 'technologie';
    
    #[Template(path: __DIR__ . '/../../view/controller/technology.latte')]
    public function index(): void
    {
        $this->addRequest('technology_list', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 100,
                'desc' => false,
                'labels' => [self::ARTICLE_LABEL],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
    
        $responses = $this->dispatchRequests('Technology List');
        $response = $responses['technology_list'];
        $contents = $response->getBody()->getContents();
    
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
    
        $this->template->data = json_decode($contents, true);
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/technology-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('technology_detail', 'POST', "article/show-one", [
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
    
        $responses = $this->dispatchRequests('Technology Detail');
        $response = $responses['technology_detail'];
        $contents = $response->getBody()->getContents();
    
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
    
        $this->template->data = json_decode($contents, true);
    }
}