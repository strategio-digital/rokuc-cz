<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;

class NewsController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/news.latte')]
    public function index(string $page = null): void
    {
        if ($this->request->getPathInfo() === $this->link('news_list', ['page' => 1])) {
            $this->redirect($this->link('news_list_home'));
        }
        
        // Todo:
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/news-detail.latte')]
    public function detail(string $slug): void
    {
        // Todo:
    }
}