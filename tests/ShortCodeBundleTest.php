<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests;

use AdrianBaez\Bundle\ShortCodeBundle\DecoderCollection;

class ShortCodeBundleTest extends TestCase
{
    /**
     * Comprueba que se añaden todos los DecoderInterface
     */
    public function testServices()
    {
        $container = $this->getKernel()->getContainer();
        $this->assertTrue($container->has(DecoderCollection::class));
        $decoderCollection = $this->getDecoderCollection();
        $expected = 'Lists: <ul><li>DummyCodeDecoded 1</li><li>DummyCodeDecoded 2</li></ul> <ul><li>DummyCodeDecoded 3</li><li>DummyCodeDecoded 4</li></ul> decoded.';
        $this->assertEquals($expected, $decoderCollection->decode('Lists: [html-list items=DummyCode 1,DummyCode 2] [html-list items=DummyCode 3,DummyCode 4] decoded.'));
    }
}
