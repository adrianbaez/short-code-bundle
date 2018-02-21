<?php

namespace AdrianBaez\Bundle\ShortCodeBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\Compiler\BracketDecoderTagPass;
use AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\Compiler\DecoderPass;
use AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\ShortCodeExtension;

class ShortCodeBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ShortCodeExtension();
    }

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DecoderPass());
        $container->addCompilerPass(new BracketDecoderTagPass());
    }
}
