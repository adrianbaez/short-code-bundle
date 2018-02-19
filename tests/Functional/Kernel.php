<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional;

use Psr\Log\NullLogger;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Kernel.
 */
class Kernel extends BaseKernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \AdrianBaez\Bundle\ShortCodeBundle\ShortCodeBundle(),
            new \AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional\Bundle\Bundle(),
        ];
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return sys_get_temp_dir().'/ShortCodeBundle/cache';
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return sys_get_temp_dir().'/ShortCodeBundle/logs';
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        foreach(['framework', 'services'] as $config){
            $loader->load(__DIR__.sprintf('/config/%s.yaml', $config));
        }
    }

    protected function build(ContainerBuilder $container)
    {
        $container->register('logger', NullLogger::class);
    }
}
