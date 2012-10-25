<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VacancyRepository extends EntityRepository
{
    public function findForAllPageBlock($town)
    {
        return $this->createSortedQueryBuilder($town)
            ->getQuery()
            ->getResult();
    }

    public function createSortedQueryBuilder($town = null)
    {
        $qb = $this->createQueryBuilder('v')
            ->orderBy('v.title');

        if ($town instanceof Town) {
            $qb->join('v.school', 's');
            $qb->andWhere('s.town = :town');
            $qb->setParameter('town', $town->getId());
        }

        return $qb;
    }
}
