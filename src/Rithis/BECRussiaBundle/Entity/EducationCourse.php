<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\EducationCourseRepository")
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
     * @ORM\ManyToOne(targetEntity="EducationCourseType", inversedBy="educationCourses")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    protected $type;

    /**
     * @ORM\Column(type="text")
     */
    protected $annotation;

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
     * @ORM\Column(nullable=true)
     */
    protected $website;

    /**
     * @ORM\Column
     */
    protected $reason;

    /**
     * @ORM\Column
     */
    protected $schedule;

    /**
     * @ORM\Column
     */
    protected $languageLevel;

    /**
     * @ORM\ManyToMany(targetEntity="School")
     * @ORM\JoinTable(name="education_courses_schools",
     *  joinColumns={@ORM\JoinColumn(name="education_course_id", referencedColumnName="id", nullable=false)},
     *  inverseJoinColumns={@ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false)}
     * )
     */
    protected $schools;

    public function __construct()
    {
        $this->schools = new ArrayCollection();
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

    public function setType(EducationCourseType $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
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

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setLanguageLevel($languageLevel)
    {
        $this->languageLevel = $languageLevel;
    }

    public function getLanguageLevel()
    {
        return $this->languageLevel;
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
        return $this->getTitle();
    }
}
