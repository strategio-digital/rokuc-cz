<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

class NavbarDataset
{
    /**
     * @return array<int,mixed>
     */
    public function bottomNavbar(): array
    {
        return [
            ['name' => 'Domů', 'link' => '/'],
            ['name' => 'O mně', 'link' => '/aktuality/o-mne'],
            ['name' => 'Služby', 'link' => '/sluzby'],
            ['name' => 'Aktuality', 'link' => '/aktuality'],
            ['name' => 'Reference', 'link' => '/reference'],
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
                'link' => '/aktuality',
                'dropdown' => null
            ],
            
            [
                'name' => 'Netěsnosti plochých střech',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Lokalizace netěsnostní',
                        'link' => '/sluzby/lokalizace-netesnosti'
                    ],
                    [
                        'name' => 'Oprava netěsností a další služby',
                        'link' => '/sluzby/oprava-netesnosti-a-dalsi-sluzby'
                    ],
                    [
                        'name' => 'Zjišťování vlhkosti v plochých střechách',
                        'link' => '/sluzby/zjistovani-vlhkosti-v-plochych-strechach'
                    ]
                ]
            ],
            
            [
                'name' => 'Další služby',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Školení firem a majitelů nemovitostí',
                        'link' => '/sluzby/skoleni-firem-a-majitelu-nemovitosti'
                    ],
                    [
                        'name' => 'Znalecký posudek na střechu',
                        'link' => '/sluzby/znalecky-posudek-na-strechu'
                    ],
                    [
                        'name' => 'Odborný posudek na střechu',
                        'link' => '/sluzby/odborny-posudek-na strechu'
                    ],
                ]
            ],
            
            [
                'name' => 'Průběh a užitečné informace',
                'link' => '#',
                'dropdown' => [
                    [
                        'name' => 'Povinné kontroly plochých střech',
                        'link' => '/sluzby/povinne-kontroly-plochych-strech'
                    ],
                    [
                        'name' => 'Doporučený servis plochých střech',
                        'link' => '/sluzby/doporuceny-servis-plochych-strech'
                    ],
                    [
                        'name' => 'Typy střech',
                        'link' => '/sluzby/typy-strech'
                    ],
                    [
                        'name' => 'Lokalizační technologie',
                        'link' => '/lokalizacni-technologie'
                    ],
                ]
            ],
            
            [
                'name' => 'Reference',
                'link' => '/reference',
                'dropdown' => null
            ],
            
            [
                'name' => 'O mně',
                'link' => '/aktuality/o-mne',
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