<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SchoolRepository extends EntityRepository
{
    public function findForAllPageBlock($town)
    {
        return $this->createSortedQueryBuilder($town)
            ->getQuery()
            ->getResult();
    }

    public function createSortedQueryBuilder($town = null)
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.title');

        if ($town instanceof Town) {
            $qb->andWhere('s.town = :town');
            $qb->setParameter('town', $town->getId());
        }

        return $qb;
    }
}
