<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TestResultRepository extends EntityRepository
{
    public function findBestMatch($points)
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.minimalPoints', 'DESC')
            ->where('r.minimalPoints <= :points')
            ->setParameter('points', $points)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
