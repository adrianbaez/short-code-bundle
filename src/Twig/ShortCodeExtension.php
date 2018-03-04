<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Twig;

use Twig\TwigFilter;

class ShortCodeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('short_code', array(Runtime::class, 'shortCodeFilter')),
        );
    }
}
