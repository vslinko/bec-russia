<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EducationCourseTypeRepository extends EntityRepository
{
    public function findForEducationCourseTypesBlock()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.position')
            ->getQuery()
            ->getResult();
    }
}
