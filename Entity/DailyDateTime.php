<?php

namespace Disjfa\MozaicBundle\Entity;

use DateTime;

/**
 * Class DailyDateTime
 * @package Disjfa\MozaicBundle\Entity
 */
class DailyDateTime extends DateTime
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format('Y-m-d');
    }
}