<?php

namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\EntityRepository;
use DateTime;

/**
 * DailyRepository
 */
class DailyRepository extends EntityRepository
{
    /**
     * @param int $maxResults
     * @return Daily[]
     */
    public function findLatest($maxResults = 16)
    {
        $qb = $this->createQueryBuilder('daily');
        $qb->orderBy('daily.dateDaily', 'DESC');
        $qb->setMaxResults($maxResults);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param DailyDateTime $dateTime
     * @return mixed
     */
    public function findDailyByDate(DailyDateTime $dateTime)
    {
        $qb = $this->createQueryBuilder('daily');
        $qb->where('daily.dateDaily = :date');
        $qb->setParameter('date', (string)$dateTime);

        return $qb->getQuery()->getOneOrNullResult();
    }

}
