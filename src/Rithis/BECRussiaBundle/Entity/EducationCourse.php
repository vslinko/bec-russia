<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table("education_courses")
 */
class EducationCourse
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="education_courses_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=140)
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @ORM\Column(length=140)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $annotation;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $website;

    /**
     * @ORM\ManyToMany(targetEntity="Town")
     * @ORM\JoinTable(name="education_courses_towns",
     *  joinColumns={@ORM\JoinColumn(name="education_course_id", referencedColumnName="id", nullable=false)},
     *  inverseJoinColumns={@ORM\JoinColumn(name="town_id", referencedColumnName="id", nullable=false)}
     * )
     */
    protected $towns;

    public function __construct()
    {
        $this->towns = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setTitle($name)
    {
        $this->title = $name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;
    }

    public function getAnnotation()
    {
        return $this->annotation;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function addTown(Town $town)
    {
        $this->towns[] = $town;
    }

    public function removeTown(Town $town)
    {
        $this->towns->removeElement($town);
    }

    public function getTowns()
    {
        return $this->towns;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
