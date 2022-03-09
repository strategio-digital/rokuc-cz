<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;

class ReferenceController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/reference.latte')]
    public function index(string $page = null): void
    {
        if ($this->request->getPathInfo() === '/reference/strana/1') {
            $this->redirect('/reference');
        }
        
        // Todo:
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/reference-detail.latte')]
    public function detail(string $slug): void
    {
        // Todo:
    }
}