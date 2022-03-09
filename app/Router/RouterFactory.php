<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use ContentioSdk\Router\BaseRouter;
use Strategio\Controller\HomeController;
use Strategio\Controller\NewsController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends BaseRouter
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        $this->add('home', '/', [HomeController::class, 'index']);
    
        $this->add('news_detail', '/aktuality/strana/{page<\d+>}', [NewsController::class, 'index']);
        $this->add('news_list', '/aktuality/{slug}', [NewsController::class, 'detail']);
        $this->add('news_list_home', '/aktuality', [NewsController::class, 'index']);
        return $routes;
    }
}