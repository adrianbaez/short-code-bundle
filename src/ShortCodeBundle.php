<?php

namespace AdrianBaez\Bundle\ShortCodeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use AdrianBaez\Bundle\ShortCodeBundle\DependencyInjection\ShortCodeExtension;

class ShortCodeBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ShortCodeExtension();
    }
}
