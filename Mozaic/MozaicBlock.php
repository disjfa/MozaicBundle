<?php

namespace Disjfa\MozaicBundle\Mozaic;

/**
 * @package Disjfa\MozaicBundle\Mozaic
 */
class MozaicBlock
{
    /**
     * @var int
     */
    private $posX;

    /**
     * @var int
     */
    private $posY;

    public function __construct($posX, $posY)
    {

    }

    /**
     * @return int
     */
    public function getPosX()
    {
        return $this->posX;
    }

    /**
     * @return int
     */
    public function getPosY()
    {
        return $this->posY;
    }
}