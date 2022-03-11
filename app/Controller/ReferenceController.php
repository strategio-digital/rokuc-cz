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

class ReferenceController extends BaseController
{
    const ARTICLE_LABEL = 'reference';
    
    #[Template(path: __DIR__ . '/../../view/controller/reference.latte')]
    public function index(string $page = '1'): void
    {
        if ($this->request->getPathInfo() === $this->link('reference_list', ['page' => 1])) {
            $this->redirect($this->link('reference_list_home'));
        }
        
        $this->addRequest('reference_list', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => (int)$page,
                'itemsPerPage' => 12,
                'desc' => true,
                'labels' => [self::ARTICLE_LABEL],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $responses = $this->dispatchRequests('Reference List');
        $response = $responses['reference_list'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/reference-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('reference_detail', 'POST', "article/show-one", [
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
        
        $responses = $this->dispatchRequests('Reference Detail');
        $response = $responses['reference_detail'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
}