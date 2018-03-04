<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Twig;
use AdrianBaez\ShortCode\DecoderCollection;

class Runtime
{
    /**
     * DecoderCollection
     * @var DecoderCollection $decoder
     */
    protected $decoder;
    
    /**
     * @param DecoderCollection $decoder
     */
    public function __construct(DecoderCollection $decoder)
    {
        $this->decoder = $decoder;
    }
    
    public function shortCodeFilter($code)
    {
        return $this->decoder->decode($code);
    }
}
