<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Interfaces;

/**
 * Interfaz para los decodificadores
 */
interface DecoderInterface
{
    /**
     * Indica si soporta el código
     * @param string $code
     * @return bool
     */
    public function supports(string $code) : bool;

    /**
     * Decodifica un código
     * @param string $code
     * @return string
     */
    public function decode(string $code) : string;
}
