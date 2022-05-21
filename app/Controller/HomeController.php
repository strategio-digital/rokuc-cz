<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use ContentioSdk\Component\AssetLoader;
use ContentioSdk\Component\StdTemplate;
use ContentioSdk\Component\Thumbnail\ThumbGen;
use ContentioSdk\Debugger\ApiDebugger;
use Latte\Engine;
use Strategio\Controller\Base\BaseController;
use Strategio\Model\ContactDataset;
use Strategio\Model\HeroSection;
use Strategio\Model\NavbarDataset;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class HomeController extends BaseController
{
    public function __construct(
        protected Engine         $latte,
        protected ApiDebugger    $apiDebugger,
        protected Response       $response,
        protected AssetLoader    $assetLoader,
        protected ThumbGen       $thumbGen,
        protected UrlGenerator   $urlGenerator,
        protected StdTemplate    $template,
        protected NavbarDataset  $navbarDataset,
        protected ContactDataset $contactDataset,
        public Request           $request,
        
        protected HeroSection $heroSection,
    )
    {
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/home.latte')]
    public function index(): void
    {
        $this->addRequest('service_list', 'POST', 'article/show-all', [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 100,
                'desc' => true,
                'labels' => ['sluzby'],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $this->addRequest('reference_list', 'POST', 'article/show-all', [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 3,
                'desc' => true,
                'labels' => ['reference'],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $this->addRequest('video_list', 'POST', 'article/show-all', [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 100,
                'desc' => true,
                'labels' => ['videa'],
                'suppressLabels' => true,
                'suppressFiles' => true,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $this->addRequest('about_me', 'POST', 'article/show-one', [
            'json' => [
                'slug' => 'o-mne',
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
        
        $this->addRequest('hero_section', 'POST', 'article/show-one', [
            'json' => [
                'slug' => 'hero-section',
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
        
        $responses = $this->dispatchRequests('Homepage');
        
        // Hero section changing images
        $heroResponse = $responses['hero_section']->getStatusCode() === Response::HTTP_OK ? json_decode($responses['hero_section']->getBody()->getContents(), true) : null;
        $this->template->heroBg = $heroResponse ? $this->heroSection->getNextImage($heroResponse) : null;
        
        $this->template->data = [
            'hero' => $heroResponse,
            'about_me' => $responses['about_me']->getStatusCode() === Response::HTTP_OK ? json_decode($responses['about_me']->getBody()->getContents(), true) : null,
            'services' => $responses['service_list']->getStatusCode() === Response::HTTP_OK ? json_decode($responses['service_list']->getBody()->getContents(), true) : [],
            'references' => $responses['reference_list']->getStatusCode() === Response::HTTP_OK ? json_decode($responses['reference_list']->getBody()->getContents(), true) : [],
            'videos' => $responses['video_list']->getStatusCode() === Response::HTTP_OK ? json_decode($responses['video_list']->getBody()->getContents(), true) : [],
        ];
    }
}