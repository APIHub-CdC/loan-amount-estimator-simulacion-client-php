<?php

namespace LAESimulacion\Client\Model;
use \LAESimulacion\Client\ObjectSerializer;

class CatalogoSegmento
{
    
    const PP = 'PP';
    const TC = 'TC';
    const TD = 'TD';
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::PP,
            self::TC,
            self::TD,
        ];
    }
}
