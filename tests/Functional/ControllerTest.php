<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional;

use AdrianBaez\Bundle\ShortCodeBundle\Tests\TestCase;

class ControllerTest extends TestCase
{
    /**
     * Prueba la disponibilidad del servicio ne un controlador
     */
    public function testDIControllerArgument()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inject-argument');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $decodedContainer = $crawler->filter('#decoded-container');
        $this->assertEquals(1, $decodedContainer->count());
        $this->assertEquals(
            'My tag contains "one-two-three" as ids, "Some text attribute" as text and a "External property"',
            $decodedContainer->text()
        );
    }

    /**
     * Prueba el filtro de twig
     */
    public function testFilter()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/filter');
        $response = $client->getResponse();
        
        $this->assertEquals(200, $response->getStatusCode());
        $decodedContainer = $crawler->filter('#decoded-container');
        $this->assertEquals(1, $decodedContainer->count());
        $this->assertEquals(
            'My tag contains "one-two-three" as ids, "Some text attribute" as text and a "External property"',
            $decodedContainer->text()
        );
    }
}
