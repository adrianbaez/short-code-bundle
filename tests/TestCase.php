<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;

/**
 * TestCase.
 */
abstract class TestCase extends WebTestCase
{

    protected static $kernel;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/ShortCodeBundleBundle/');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        static::$kernel = null;
    }

	/**
	 * Devuelve un servicio del container
	 * @param string $id El identificador del servicio
	 */
    protected function getService($id)
    {
        if(!self::$kernel){
            self::$kernel = static::bootKernel();
        }
        return self::$kernel->getContainer()->get($id);
    }
}
