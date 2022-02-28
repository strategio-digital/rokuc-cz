<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends \ContentioSdk\Router\RouterFactory
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        
        /*$this->add('article_detail', '/clanky/{slug}', [
            \Strategio\Controller\ArticleController::class,
            'index'
        ]);*/
        
        return $routes;
    }
}