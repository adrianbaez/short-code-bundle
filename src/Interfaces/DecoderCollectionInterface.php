<?php

namespace AdrianBaez\Bundle\ShortCodeBundle\Interfaces;

/**
 * Interfaz de una colección de decodificadores
 */
interface DecoderCollectionInterface
{
    /**
     * Indica si soporta el código
     * @param DecoderInterface $decoder
     * @return DecoderCollectionInterface
     */
    public function add(DecoderInterface $decoder) : DecoderCollectionInterface;

    /**
     * Decodifica un código
     * En caso de que en la colección de decodificadores ninguno soporte
     * el código debería devolver el mismo código
     * @param string $code
     * @return string
     */
    public function decode(string $code) : string;
}
