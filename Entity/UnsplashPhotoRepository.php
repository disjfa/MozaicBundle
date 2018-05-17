<?php

namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\PaginatorInterface;

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

    public function findAllPaginated(PaginatorInterface $paginator, $page = 1, $limit = 12)
    {
        $qb = $this->createQueryBuilder('u');
        return $paginator->paginate($qb, $page, $limit);
    }
}
