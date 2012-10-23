<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("phones")
 */
class Phone
{
    /**
     * @ORM\Column(length=32)
     * @ORM\Id
     */
    protected $number;

    /**
     * @ORM\Column("visible_for_town", type="boolean")
     */
    protected $visibleForTown;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="phones")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $school;

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setVisibleForTown($visibleForTown)
    {
        $this->visibleForTown = $visibleForTown;
    }

    public function isVisibleForTown()
    {
        return $this->visibleForTown;
    }

    public function setSchool(School $school)
    {
        $this->school = $school;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function __toString()
    {
        return $this->getNumber();
    }
}
