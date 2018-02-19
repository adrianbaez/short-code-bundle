<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Decoders;

use AdrianBaez\Bundle\ShortCodeBundle\Interfaces\DecoderInterface;

/**
 * Reemplaza las coincidencias de DummyCode por DummyCodeDecoded
 */
class DummyDecoder implements DecoderInterface
{
    /**
     * Expresión regular de coincidencia
     * @var string
     */
    const REGEX = '/DummyCode/';

    /**
     * @inheritDoc
     */
    public function supports(string $encoded): bool
    {
        return preg_match(static::REGEX, $encoded) > 0;
    }

    /**
     * @inheritDoc
     */
    public function decode(string $encoded): string
    {
        return preg_replace(static::REGEX, 'DummyCodeDecoded', $encoded);
    }
}
