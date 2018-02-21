<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional\Decoders\BracketDecoder;

use AdrianBaez\Bundle\ShortCodeBundle\Interfaces\BracketDecoderTagInterface;

class HtmlImage implements BracketDecoderTagInterface
{
    /**
     * @inheritDoc
     */
    public function getTag(): string
    {
        return 'img';
    }

    /**
     * @inheritDoc
     */
    public function decode(array $attributes): string
    {
        $attrs = [
            ['src', $attributes['src'] ?? ''],
            ['alt', $attributes['alt'] ?? ''],
            ['title', $attributes['title'] ?? ''],
        ];
        $attrs = array_map(function ($attr) {
            list($key, $value) = $attr;
            return sprintf('%s="%s"', $key, $value);
        }, $attrs);
        return sprintf('<img %s>', implode(' ', $attrs));
    }
}
