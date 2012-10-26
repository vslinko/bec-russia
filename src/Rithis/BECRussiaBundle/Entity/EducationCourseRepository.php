<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EducationCourseRepository extends EntityRepository
{
    public function findByTypeAndTown(EducationCourseType $type, $town = null)
    {
        $qb = $this->createQueryBuilder('ec')
            ->orderBy('ec.title')
            ->where('ec.type = :type')
            ->setParameter('type', $type->getId());

        if ($town instanceof Town) {
            $qb->join('ec.schools', 's');
            $qb->andWhere('s.town = :town');
            $qb->setParameter('town', $town->getId());
        }

        return $qb->getQuery()->getResult();
    }
}
