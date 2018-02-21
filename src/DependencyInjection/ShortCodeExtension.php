<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection;

use AdrianBaez\ShortCode\Interfaces\BracketDecoderTagInterface;
use AdrianBaez\ShortCode\Interfaces\DecoderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ShortCodeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(DecoderInterface::class)
            ->addTag('short_code.decoder')
        ;
        $container->registerForAutoconfiguration(BracketDecoderTagInterface::class)
            ->addTag('short_code.bracket_decoder_tag')
        ;
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
