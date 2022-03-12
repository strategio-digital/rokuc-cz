<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller\Base;

use ContentioSdk\Component\AssetLoader;
use ContentioSdk\Debugger\ApiDebugger;
use Latte\Engine;
use Strategio\Model\ContactDataset;
use Strategio\Model\NavbarDataset;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class BaseController extends \ContentioSdk\Controller\Base\BaseController
{
    public function __construct(
        protected Engine         $latte,
        protected ApiDebugger    $apiDebugger,
        protected Response       $response,
        protected AssetLoader    $assetLoader,
        protected UrlGenerator   $urlGenerator,
        protected NavbarDataset  $navbarDataset,
        protected ContactDataset $contactDataset,
        public Request           $request,
    )
    {
    }
    
    public function startup(): void
    {
        parent::startup();
        
        $this->template->navbar = $this->navbarDataset;
        $this->template->contact = $this->contactDataset;
    }
}