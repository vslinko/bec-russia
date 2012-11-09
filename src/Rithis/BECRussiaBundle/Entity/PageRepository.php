<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    public function createIsRealQueryBuilder()
    {
        return $this->createQueryBuilder('p')
            ->where('p.uri IS NOT NULL');
    }
}
