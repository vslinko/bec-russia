<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("online_requests")
 */
class OnlineRequest
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="online_requests_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=255)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="School")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    protected $school;

    /**
     * @ORM\Column(length=8)
     * @Assert\NotBlank
     * @Assert\Choice({"children", "teenager", "adult"})
     */
    protected $age;

    /**
     * @ORM\ManyToOne(targetEntity="EducationCourse")
     * @ORM\JoinColumn(name="education_course_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    protected $educationCourse;

    /**
     * @ORM\Column("language_level")
     * @Assert\NotBlank
     */
    protected $languageLevel;

    /**
     * @ORM\Column(type="text")
     */
    protected $note;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Regex("/^[-+() 0-9]+$/")
     */
    protected $phone;

    /**
     * @ORM\Column("created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSchool($school)
    {
        $this->school = $school;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setEducationCourse($educationCourse)
    {
        $this->educationCourse = $educationCourse;
    }

    public function getEducationCourse()
    {
        return $this->educationCourse;
    }

    public function setLanguageLevel($languageLevel)
    {
        $this->languageLevel = $languageLevel;
    }

    public function getLanguageLevel()
    {
        return $this->languageLevel;
    }

    public function setNote($note)
    {
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
