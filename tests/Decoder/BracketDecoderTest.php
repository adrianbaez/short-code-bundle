<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Decoder;

use AdrianBaez\Bundle\ShortCodeBundle\Decoder\BracketDecoder;
use AdrianBaez\Bundle\ShortCodeBundle\Tests\TestCase;

class BracketDecoderTest extends TestCase
{
    /**
     * Prueba que se añaden las tags
     */
    public function testAddTag()
    {
        $bracketDecoder = new BracketDecoder;
        $this->assertEquals(0, count($bracketDecoder->getAvailableTags()));

        $bracketDecoder->addTag('my-tag', function ($match) {
        });
        $this->assertEquals(1, count($bracketDecoder->getAvailableTags()));
        // Si se añadde la misma se sobreescribe
        $bracketDecoder->addTag('my-tag', function ($match) {
        });
        $this->assertEquals(1, count($bracketDecoder->getAvailableTags()));

        $bracketDecoder->addTag('my-other-tag', function ($match) {
        });
        $this->assertEquals(2, count($bracketDecoder->getAvailableTags()));
    }

    /**
     * Prueba que se añaden las tags
     */
    public function testGetAvailableTags()
    {
        $bracketDecoder = new BracketDecoder;
        $this->assertEquals(0, count($bracketDecoder->getAvailableTags()));
        $this->assertEquals([], $bracketDecoder->getAvailableTags());

        $bracketDecoder->addTag('my-tag', function ($match) {
        });
        $this->assertEquals(['my-tag'], $bracketDecoder->getAvailableTags());

        $bracketDecoder->addTag('my-other-tag', function ($match) {
        });
        $this->assertEquals(['my-tag', 'my-other-tag'], $bracketDecoder->getAvailableTags());
    }

    /**
     * Prueba que la expresión regular va cambiando a medida que se añaden tags
     */
    public function testGetRegEx()
    {
        $bracketDecoder = new BracketDecoder;
        $this->assertEquals('/\[((?:))(.*)]/U', $bracketDecoder->getRegEx());

        $bracketDecoder->addTag('my-tag', function ($match) {
        });
        $this->assertEquals('/\[((?:my-tag))(.*)]/U', $bracketDecoder->getRegEx());

        $bracketDecoder->addTag('my-other-tag', function ($match) {
        });
        $this->assertEquals('/\[((?:my-tag|my-other-tag))(.*)]/U', $bracketDecoder->getRegEx());
    }

    /**
     * Prueba de supports
     */
    public function testSupports()
    {
        $bracketDecoder = new BracketDecoder;
        $this->assertFalse($bracketDecoder->supports('Text with [my-tag] inside.'), 'Si no hay tags no tiene que soportar nada');

        $bracketDecoder->addTag('my-tag', function ($match) {
        });
        $this->assertTrue($bracketDecoder->supports('Text with [my-tag] inside.'), 'Tiene que soportar texto con [my-tag]');
        $this->assertTrue($bracketDecoder->supports('Text with [my-tag attr=value] inside.'), 'Tiene que soportar texto con [my-tag attr=value]');
        $this->assertFalse($bracketDecoder->supports('Text with [my-other-tag] inside.'), 'NO tiene que soportar texto con [my-other-tag]');
        $this->assertFalse($bracketDecoder->supports('Text with [my-other-tag attr=value] inside.'), 'No tiene que soportar texto con [my-other-tag attr=value]');

        $bracketDecoder->addTag('my-other-tag', function ($match) {
        });
        $this->assertTrue($bracketDecoder->supports('Text with [my-tag] inside.'), 'Tiene que seguir soportando texto con [my-tag]');
        $this->assertTrue($bracketDecoder->supports('Text with [my-tag attr=value] inside.'), 'Tiene que seguir soportando texto con [my-tag attr=value]');
        $this->assertTrue($bracketDecoder->supports('Text with [my-other-tag] inside.'), 'Tiene que soportar texto con [my-other-tag]');
        $this->assertTrue($bracketDecoder->supports('Text with [my-other-tag attr=value] inside.'), 'Tiene que soportar texto con [my-other-tag attr=value]');
    }

    /**
     * Prueba que se obtengan todos los atributos con sus valores
     */
    public function testGetAttributes()
    {
        $bracketDecoder = new BracketDecoder;
        $this->assertEquals([], $bracketDecoder->getAttributes(''));
        $this->assertEquals([
            'attr' => 'value'
        ], $bracketDecoder->getAttributes('attr=value'));
        $this->assertEquals([
            'attr' => 'value',
            'spaced' => 'spaced attribute'
        ], $bracketDecoder->getAttributes(' attr=value spaced=spaced attribute'));
    }

    /**
     * Prueba la docodificación
     * @return [type] [description]
     */
    public function testDecode()
    {
        $externalVar = 'External variable';
        $bracketDecoder = new BracketDecoder;

        $bracketDecoder->addTag('my-tag', function ($attributes) use ($externalVar) {
            $ids = $attributes['ids'] ?? '';
            $ids = explode(',', $ids);
            $text = $attributes['text'] ?? '';
            return sprintf('My tag contains "%s" as ids, "%s" as text and a "%s"', implode('-', $ids), $text, $externalVar);
        });

        $bracketDecoder->addTag('my-other-tag', function ($attributes) {
            $colors = $attributes['colors'] ?? '';
            $colors = explode(',', $colors);
            $colors = array_map(function ($color) {
                return trim($color);
            }, $colors);
            $title = $attributes['title'] ?? '';
            return sprintf('My other tag contains "%s" as colors and "%s" as title', implode(', ', $colors), $title);
        });

        $expected = 'My tag contains "" as ids, "" as text and a "External variable"';
        $this->assertEquals($expected, $bracketDecoder->decode('[my-tag]'));
        $this->assertEquals($expected, $bracketDecoder->decode('[my-tag ]'));
        $this->assertEquals($expected, $bracketDecoder->decode('[my-tag unregistered=Dummy value]'));

        $expected = 'My tag contains "1-2-3" as ids, "My text" as text and a "External variable"';
        $this->assertEquals($expected, $bracketDecoder->decode('[my-tag ids=1,2,3 text=My text]'));

        $expected = 'My tag contains "1-2-3" as ids, "My text" as text and a "External variable" - My other tag contains "red, green, blue" as colors and "My title" as title';
        $this->assertEquals($expected, $bracketDecoder->decode('[my-tag ids="1,2,3" text=\'My text\'] - [my-other-tag colors= red, green , blue title=My title]'));
    }
}
