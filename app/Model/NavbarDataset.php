<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

use Symfony\Component\Routing\Generator\UrlGenerator;

class NavbarDataset
{
    public function __construct(protected UrlGenerator $generator)
    {
    }
    
    /**
     * @return array<int,mixed>
     */
    public function bottomNavbar(): array
    {
        return [
            ['name' => 'Domů', 'link' => $this->generator->generate('home')],
            ['name' => 'O mně', 'link' => $this->generator->generate('news_detail', ['slug' => 'o-mne'])],
            ['name' => 'Aktuality', 'link' => $this->generator->generate('news_list_home')],
            ['name' => 'Reference', 'link' => $this->generator->generate('reference_list_home')],
            ['name' => 'Kontakt', 'link' => '#kontakt']
        ];
    }
    
    /**
     * @return array<int,mixed>
     */
    public function topNavbar(): array
    {
        return [
            [
                'name' => 'Aktuality',
                'link' => $this->generator->generate('news_list_home'),
                'dropdown' => null
            ],
            
            [
                'name' => 'Netěsnosti plochých střech',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Lokalizace netěsnostní',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'lokalizace-netesnosti'])
                    ],
                    [
                        'name' => 'Oprava netěsností a další služby',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'oprava-netesnosti-a-dalsi-sluzby'])
                    ],
                    [
                        'name' => 'Zjišťování vlhkosti v plochých střechách',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'zjistovani-vlhkosti-v-plochych-strechach'])
                    ]
                ]
            ],
            
            [
                'name' => 'Další služby',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Školení firem a majitelů nemovitostí',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'skoleni-firem-a-majitelu-nemovitosti'])
                    ],
                    [
                        'name' => 'Znalecký posudek na střechu',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'znalecky-posudek-na-strechu'])
                    ],
                    [
                        'name' => 'Odborný posudek na střechu',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'odborny-posudek-na-strechu'])
                    ],
                ]
            ],
            
            [
                'name' => 'Průběh a užitečné informace',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Povinné kontroly plochých střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'povinne-kontroly-plochych-strech'])
                    ],
                    [
                        'name' => 'Doporučený servis plochých střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'doporuceny-servis-plochych-strech'])
                    ],
                    [
                        'name' => 'Typy střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'typy-strech'])
                    ],
                    [
                        'name' => 'Lokalizační technologie',
                        'link' => $this->generator->generate('technology_list')
                    ],
                ]
            ],
            
            [
                'name' => 'Reference',
                'link' => $this->generator->generate('reference_list_home'),
                'dropdown' => null
            ],
            
            [
                'name' => 'O mně',
                'link' => $this->generator->generate('news_detail', ['slug' => 'o-mne']),
                'dropdown' => null
            ],
            
            [
                'name' => 'Kontakt',
                'link' => '#kontakt',
                'dropdown' => null
            ],
        ];
    }
}