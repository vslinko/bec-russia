<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\PhoneRepository")
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
     * @ORM\Column(type="boolean")
     */
    protected $global;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="phones")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * @Assert\NotBlank
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

    public function setGlobal($default)
    {
        $this->global = $default;
    }

    public function isGlobal()
    {
        return $this->global;
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
