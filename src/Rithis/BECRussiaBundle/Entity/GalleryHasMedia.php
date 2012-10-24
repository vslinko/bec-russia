<?php

namespace Rithis\BECRussiaBundle\Entity;

use Sonata\MediaBundle\Entity\BaseGalleryHasMedia;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("media_galleries")
 */
class GalleryHasMedia extends BaseGalleryHasMedia
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="media_galleries_id_seq")
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
