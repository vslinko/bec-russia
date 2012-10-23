<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table("towns")
 */
class Town
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="towns_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=64)
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * @ORM\Column(length=64)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="School", mappedBy="town")
     */
    protected $schools;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->schools = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addSchool(School $school)
    {
        $this->schools[] = $school;
    }

    public function removeSchool(School $school)
    {
        $this->schools->removeElement($school);
    }

    public function getSchools()
    {
        return $this->schools;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
