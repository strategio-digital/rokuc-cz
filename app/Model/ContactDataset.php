<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Model;

class ContactDataset
{
    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        $data = [
            'mail' => 'roman@rokuc.cz',
            'phone' => '+420 603 258 686',
            'address' => 'Chlebov 60, 329 01 Soběslav',
            'facebook' => 'fb.com/znalecrokuc',
            'youtube' => 'https://youtube.com/rokuc',
            'google_maps' => 'https://goo.gl/maps/cfPs4VgMUgN2',
            'mapy_cz' => 'https://en.mapy.cz/s/3qcRt',
            'id' => '12906590',
            'vat_id' => 'CZ7102101721',
            'bank_account' => '259997364/0300'
        ];
        
        return $data[$key];
    }
}