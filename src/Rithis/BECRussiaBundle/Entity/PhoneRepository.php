<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PhoneRepository extends EntityRepository
{
    public function findVisibleInTown(Town $town)
    {
        return $this->createQueryBuilder('p')
            ->join('p.school', 's')
            ->where('p.visibleForTown = TRUE')
            ->andWhere('s.town = :town')
            ->setParameter('town', $town->getId())
            ->getQuery()
            ->getResult();
    }
}
