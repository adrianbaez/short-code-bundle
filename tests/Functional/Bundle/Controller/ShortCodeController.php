<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Tests\Functional\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdrianBaez\ShortCode\DecoderCollection;

class ShortCodeController extends Controller
{
    public function injectArgument(DecoderCollection $decoder)
    {
        return $this->render('inject-argument.html.twig', [
            'decoded' => $decoder->decode('[my-tag ids=one,two,three  text="Some text attribute" ]')
        ]);
    }
    
    public function filter()
    {
        return $this->render('filter.html.twig', [
            'toDecode' => '[my-tag ids=one,two,three  text="Some text attribute" ]'
        ]);
    }
}
