<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;

class ArticleController extends \ContentioSdk\Controller\ArticleController
{
    #[Template(path: __DIR__ . '/../../view/controller/article.latte')]
    public function index(string $slug): void
    {
        parent::index($slug);
    }
}