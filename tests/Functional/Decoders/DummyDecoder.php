<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional\Decoders;

use AdrianBaez\Bundle\ShortCodeBundle\Decoder\RegEx;

/**
 * Reemplaza las coincidencias de DummyCode por DummyCodeDecoded
 */
class DummyDecoder extends RegEx
{
    /**
     * Expresión regular de coincidencia
     * @var string
     */
    const REGEX = '/DummyCode/';

    /**
     * Devuelve una lista
     * @param array $match
     * @return string
     */
    public function replaceCallback(array $match) : string
    {
        return 'DummyCodeDecoded';
    }
}
