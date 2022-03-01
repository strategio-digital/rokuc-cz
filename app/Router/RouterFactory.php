<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use ContentioSdk\Router\BaseRouter;
use Strategio\Controller\HomeController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends BaseRouter
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        $this->add('home', '/', [HomeController::class, 'index']);
        return $routes;
    }
}