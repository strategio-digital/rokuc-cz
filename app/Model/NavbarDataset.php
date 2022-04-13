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
            ['name' => 'O mně', 'link' => $this->generator->generate('about_me')],
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
                        'name' => 'Lokalizace netěsností',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'lokalizace-netesnosti'])
                    ],
                    [
                        'name' => 'Oprava netěsností a další servis',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'oprava-netesnosti-a-dalsi-servis'])
                    ],
                    [
                        'name' => 'Zjišťování vlhkosti v plochých střechách',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'zjistovani-vlhkosti-v-plochych-strechach'])
                    ],
                    [
                        'name' => 'Kontrola těsnosti střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'kontrola-tesnosti-strech'])
                    ],
                    [
                        'name' => 'Kontrola řemeslného provedení',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'kontrola-remeslneho-provedeni'])
                    ],
                    [
                        'name' => 'Měření úniku tepla termokamerou z dronu',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'mereni-uniku-tepla-termokamerou-z-dronu'])
                    ],
                    [
                        'name' => 'Správa a údržba plochých střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'sprava-a-udrzba-plochych-strech'])
                    ],
                    [
                        'name' => 'Návrh ploché střechy a příprava stavby',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'navrh-ploche-strechy-a-priprava-stavby'])
                    ],
                    [
                        'name' => 'Návrh bezpečnostního systému',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'navrh-bezpecnostniho-systemu'])
                    ],
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
                    [
                        'name' => 'Kontrolní prohlídka nemovitosti před koupí',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'kontrolni-prohlidka-nemovitosti-pred-koupi'])
                    ],
                    [
                        'name' => 'Poradenství v oblasti střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'poradenstvi-v-oblasti-strech'])
                    ],
                ]
            ],
            
            [
                'name' => 'Průběh a užitečné informace',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Lokalizační technologie',
                        'link' => $this->generator->generate('technology_list')
                    ],
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
                        'name' => 'Prvky střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'prvky-strech'])
                    ],
                    [
                        'name' => 'Typy vad střech',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'typy-vad-strech'])
                    ],
                    [
                        'name' => 'Typy zkoušek',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'typy-zkousek'])
                    ],
                    [
                        'name' => 'Průběh zkoušky',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'prubeh-zkousky'])
                    ],
                    [
                        'name' => 'Vyhodnocení zkoušky',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'vyhodnoceni-zkousky'])
                    ],
                    [
                        'name' => 'Měřící technika',
                        'link' => $this->generator->generate('service_detail', ['slug' => 'merici-technika'])
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
                'link' => $this->generator->generate('about_me'),
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