<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller\Base;

use ContentioSdk\Component\AssetLoader;
use ContentioSdk\Component\StdTemplate;
use ContentioSdk\Component\Thumbnail\ThumbGen;
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
        protected ThumbGen       $thumbGen,
        protected UrlGenerator   $urlGenerator,
        protected StdTemplate    $template,
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
        
        $this->redirectToWww('rokuc.cz');
    }
    
    public function redirectToWww(string $domain): void
    {
        $host = $this->request->getHost();
        $port = $this->request->getPort() === 80 ? '' : (':' . $this->request->getPort());
        $target = $this->request->getScheme() . '://www.' . $host . $port . $this->request->getRequestUri();
    
        if ($host === $domain) {
            $this->response->headers->set('Location', $target);
            $this->response->setStatusCode(301);
            $this->response->sendHeaders();
            
            if ($_ENV['APP_ENV_MODE'] !== 'develop') {
                fastcgi_finish_request();
            }
            exit;
        }
    }
}