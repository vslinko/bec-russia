<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TownRepository extends EntityRepository
{
    public function findForTownSelectBlock()
    {
        return $this->createSortedQueryBuilder()
            ->getQuery()
            ->getResult();
    }

    public function createSortedQueryBuilder()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.name');
    }
}
