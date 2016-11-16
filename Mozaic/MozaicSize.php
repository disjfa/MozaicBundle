<?php

namespace Disjfa\MozaicBundle\Mozaic;

/**
 * @package Disjfa\MozaicBundle\Mozaic
 */
class MozaicSize
{
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;

    public function __construct($width, $height = null)
    {
        $this->width = $width;
        if (null === $height) {
            $this->height = $width / 16 * 9;
        } else {
            $this->height = $height;
        }
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


}