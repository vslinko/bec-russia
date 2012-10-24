<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function findForCentreNewsBlock()
    {
        return $this->createSortedQueryBuilder()
            ->where('n.school is null')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findForSchoolsNewsBlock()
    {
        return $this->createSortedQueryBuilder()
            ->where('n.school is not null')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function createSortedQueryBuilder()
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.createdAt', 'desc');
    }
}
