<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\Compiler;

use AdrianBaez\ShortCode\DecoderCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class DecoderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(DecoderCollection::class)) {
            return;
        }
        $definition = $container->findDefinition(DecoderCollection::class);
        $taggedServices = $container->findTaggedServiceIds('short_code.decoder');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('add', array(new Reference($id)));
        }
    }
}
