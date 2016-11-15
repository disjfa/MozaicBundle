<?php

namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UnsplashPhotoRepository
 */
class UnsplashPhotoRepository extends EntityRepository
{
    /**
     * @param string $id
     * @return null|object
     */
    public function find($id)
    {
        return $this->findOneBy(['unsplashId' => $id]);
    }
}
