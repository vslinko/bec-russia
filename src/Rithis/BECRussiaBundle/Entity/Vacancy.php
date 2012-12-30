<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\VacancyRepository")
 * @ORM\Table("vacancies")
 */
class Vacancy
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="vacancies_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=140)
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @ORM\Column(length=140)
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $annotation;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="news")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $school;

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

    public function setTitle($title)
    {
        $this->title = $title;
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
        return $this->getTitle();
    }
}
