<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;

class TechnologyController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/technology.latte')]
    public function index(): void
    {
        // Todo:
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/technology-detail.latte')]
    public function detail(string $slug): void
    {
        // Todo:
    }
}