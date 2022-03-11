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
    const NEWS_LABEL = 'aktuality';
    
    #[Template(path: __DIR__ . '/../../view/controller/news.latte')]
    public function index(string $page = '1'): void
    {
        if ($this->request->getPathInfo() === $this->link('news_list', ['page' => 1])) {
            $this->redirect($this->link('news_list_home'));
        }
        
        $this->addRequest('article_list', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => (int)$page,
                'itemsPerPage' => 12,
                'desc' => true,
                'labels' => [self::NEWS_LABEL],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $responses = $this->dispatchRequests('Article List');
        $response = $responses['article_list'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/news-detail.latte')]
    public function detail(string $slug): void
    {
        $this->addRequest('article', 'POST', "article/show-one", [
            'json' => [
                'slug' => $slug,
                'suppressLabels' => true,
                'suppressFiles' => true,
                'suppressParagraphs' => false,
                'suppressParagraphFiles' => false,
                'suppressPrevNext' => false,
                'suppressPrevNextFiles' => false,
                'prevNextByLabel' => self::NEWS_LABEL
            ]
        ]);
        
        $responses = $this->dispatchRequests('Article Detail');
        $response = $responses['article'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
    }
}