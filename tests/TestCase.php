<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests;

use AdrianBaez\Bundle\ShortCodeBundle\DecoderCollection;
use AdrianBaez\Bundle\ShortCodeBundle\Interfaces\DecoderCollectionInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

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
	 * @return KernelInterface
	 */
    protected function getKernel()
    {
        if(!self::$kernel){
            self::$kernel = static::bootKernel();
        }
        return self::$kernel;
    }

	/**
	 * Devuelve un servicio del container
	 * @param string $id El identificador del servicio
	 */
    protected function getService($id)
    {
        return $this->getKernel()->getContainer()->get($id);
    }

    /**
     * @return DecoderCollectionInterface
     */
    public function getDecoderCollection()
    {
        return $this->getService(DecoderCollection::class);
    }
}
