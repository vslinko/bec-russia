<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GalleryRepository extends EntityRepository
{
    public function createSchoolQueryBuilder(School $school)
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.createdAt', 'DESC')
            ->where('g.school = :school')
            ->andWhere('g.context = :context')
            ->setParameter('school', $school->getId())
            ->setParameter('context', 'school_gallery');
    }
}
