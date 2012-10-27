<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PollRepository extends EntityRepository
{
    public function findForAllPage()
    {
        return $this->createSortedQueryBuilder()
            ->getQuery()
            ->getResult();
    }

    public function findLastOne()
    {
        return $this->createSortedQueryBuilder()
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function createSortedQueryBuilder()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC');
    }
}
