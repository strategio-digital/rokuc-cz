<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use ContentioSdk\Router\BaseRouter;
use Strategio\Controller\AboutMeController;
use Strategio\Controller\HomeController;
use Strategio\Controller\NewsController;
use Strategio\Controller\ProcessController;
use Strategio\Controller\ReferenceController;
use Strategio\Controller\ServiceController;
use Strategio\Controller\TechnologyController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends BaseRouter
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        $this->add('home', '/', [HomeController::class, 'index']);
        $this->add('about_me', '/o-mne', [AboutMeController::class, 'index']);
        
        $this->add('news_list_home', '/aktuality', [NewsController::class, 'index']);
        $this->add('news_list', '/aktuality/strana/{page<\d+>}', [NewsController::class, 'index']);
        $this->add('news_detail', '/aktuality/{slug}', [NewsController::class, 'detail']);
        
        $this->add('reference_list_home', '/reference', [ReferenceController::class, 'index']);
        $this->add('reference_list', '/reference/strana/{page<\d+>}', [ReferenceController::class, 'index']);
        $this->add('reference_detail', '/reference/{slug}', [ReferenceController::class, 'detail']);
        
        $this->add('service_detail', '/sluzby/{slug}', [ServiceController::class, 'detail']);
        
        $this->add('technology_list', '/lokalizacni-technologie', [TechnologyController::class, 'index']);
        $this->add('technology_detail', '/technologie/{slug}', [TechnologyController::class, 'detail']);
    
        $this->add('process_detail', '/prubeh-a-uzitecne-informace/{slug}', [ProcessController::class, 'detail']);
        
        return $routes;
    }
}