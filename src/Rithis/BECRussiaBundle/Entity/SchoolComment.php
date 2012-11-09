<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("schools_comments")
 */
class SchoolComment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="schools_comments_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column("author_name", length=140)
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=140)
     */
    protected $authorName;

    /**
     * @ORM\Column("author_email")
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $authorEmail;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min=20)
     */
    protected $text;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $moderated = false;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="comments")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false)
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

    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setModerated($moderated)
    {
        $this->moderated = $moderated;
    }

    public function isModerated()
    {
        return $this->moderated;
    }

    public function setSchool($school)
    {
        $this->school = $school;
    }

    public function getSchool()
    {
        return $this->school;
    }
}
