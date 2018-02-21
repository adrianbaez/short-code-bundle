<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use AdrianBaez\Bundle\ShortCodeBundle\Decoder\BracketDecoder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class BracketDecoderTagPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(BracketDecoder::class)) {
            return;
        }
        $definition = $container->findDefinition(BracketDecoder::class);
        $taggedServices = $container->findTaggedServiceIds('short_code.bracket_decoder_tag');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addTagDecoder', [new Reference($id)]);
        }
    }
}
