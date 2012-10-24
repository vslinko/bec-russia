<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function findForCentreNewsBlock()
    {
        return $this->createSortedQueryBuilder()
            ->where('n.school IS NULL')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findForSchoolsNewsBlock($town)
    {
        $qb = $this->createSortedQueryBuilder($town)
            ->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }

    public function createSortedQueryBuilder($town = null)
    {
        $qb = $this->createQueryBuilder('n')
            ->orderBy('n.createdAt', 'DESC');

        if ($town instanceof Town) {
            $qb->join('n.school', 's');
            $qb->andWhere('s.town = :town');
            $qb->setParameter('town', $town->getId());
        }

        return $qb;
    }
}
