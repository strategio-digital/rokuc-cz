<?php

namespace Strategio\Model;

use Nette\Utils\Strings;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeroSection
{
    public function __construct(protected Request $request, protected Response $response)
    {
    }
    
    /**
     * @param array<string, mixed> $response
     * @return array<string, mixed>|null
     */
    public function getNextImage(array $response): array|null
    {
        $files = array_filter($response['item']['files'], fn($file) => Strings::startsWith($file['mimeType'], 'image/'));
        $files = array_values($files);
        
        if (count($files) === 0) {
            return null;
        }
        
        $index = (int)$this->request->cookies->get('hero_image_idx') ?: 0;
        $index = count($files) > $index + 1 ? ++$index : 0;
        
        $this->response->headers->setCookie(new Cookie('hero_image_idx', (string)$index));
        
        return $files[$index];
    }
}