<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Decoders;

use AdrianBaez\Bundle\ShortCodeBundle\Interfaces\DecoderInterface;

/**
 * Reemplaza las coincidencias del código por una lista html
 */
class HtmlListDecoder implements DecoderInterface
{
    /**
     * Expresión regular de coincidencia
     * @var string
     */
    const REGEX = '/\[html-list items=(.*)\]/U';

    /**
     * @inheritDoc
     */
    public function supports(string $encoded): bool
    {
        return preg_match_all(static::REGEX, $encoded) > 0;
    }

    /**
     * @inheritDoc
     */
    public function decode(string $encoded): string
    {
        return preg_replace_callback(static::REGEX, [$this, 'getList'], $encoded);
    }

    /**
     * Devuelve una lista
     * @param  array $match
     * @return string
     */
    protected function getList($match)
    {
        $items = explode(',', $match[1]);
        return sprintf('<ul><li>%s</li></ul>', implode('</li><li>', $items));
    }
}
