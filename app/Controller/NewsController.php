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

class NewsController extends BaseController
{
    const ARTICLE_LABEL = 'aktuality';
    
    #[Template(path: __DIR__ . '/../../view/controller/news.latte')]
    public function index(string $page = '1'): void
    {
        if ($this->request->getPathInfo() === $this->link('news_list', ['page' => 1])) {
            $this->redirect($this->link('news_list_home'));
        }
        
        $this->addRequest('news_list', 'POST', "article/show-all", [
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
        
        $responses = $this->dispatchRequests('News List');
        $response = $responses['news_list'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/news-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('news_detail', 'POST', "article/show-one", [
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
        
        $responses = $this->dispatchRequests('News Detail');
        $response = $responses['news_detail'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
}