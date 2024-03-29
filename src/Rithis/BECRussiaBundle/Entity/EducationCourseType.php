<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\EducationCourseTypeRepository")
 * @ORM\Table("education_course_types")
 */
class EducationCourseType
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="education_courses_types_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=64)
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @ORM\Column(length=64)
     */
    protected $title;

    /**
     * @ORM\Column
     */
    protected $note;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\OneToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=false)
     */
    protected $image;

    /**
     * @ORM\Column(length=8, nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\OneToMany(targetEntity="EducationCourse", mappedBy="type")
     */
    protected $educationCourses;

    public function __construct()
    {
        $this->educationCourses = new ArrayCollection();
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

    public function setNote($note)
    {
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function addEducationCourse(EducationCourse $educationCourse)
    {
        $this->educationCourses[] = $educationCourse;
    }

    public function removeEducationCourse(EducationCourse $educationCourse)
    {
        $this->educationCourses->removeElement($educationCourse);
    }

    public function getEducationCourses()
    {
        return $this->educationCourses;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    
    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
