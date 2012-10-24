<?php

namespace Rithis\BECRussiaBundle\Entity;

use Sonata\MediaBundle\Entity\BaseGallery;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("galleries")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="galleries_id_seq")
     */
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
