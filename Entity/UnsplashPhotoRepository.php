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
     * @param null $lockMode
     * @param null $lockVersion
     * @return null|object
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        return $this->findOneBy(['unsplashId' => $id]);
    }
}
