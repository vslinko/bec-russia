<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\SchoolRepository")
 * @ORM\Table("schools")
 */
class School
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="schools_id_seq")
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
     * @ORM\Column
     */
    protected $address;

    /**
     * @ORM\Column(type="text")
     */
    protected $about;

    /**
     * @ORM\Column(type="text")
     */
    protected $discounts;

    /**
     * @ORM\OneToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=false)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Town", inversedBy="schools")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id", nullable=false)
     */
    protected $town;

    /**
     * @ORM\OneToMany(targetEntity="Teacher", mappedBy="school")
     */
    protected $teachers;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="school")
     */
    protected $news;

    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="school", cascade={"persist"})
     */
    protected $phones;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->phones = new ArrayCollection();
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

    public function setAddress($website)
    {
        $this->address = $website;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAbout($about)
    {
        $this->about = $about;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
    }

    public function getDiscounts()
    {
        return $this->discounts;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setTown($town)
    {
        $this->town = $town;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function addTeacher(Teacher $teacher)
    {
        $this->teachers[] = $teacher;
    }

    public function removeTeacher(Teacher $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    public function getTeachers()
    {
        return $this->teachers;
    }

    public function addNews(News $news)
    {
        $this->news[] = $news;
    }

    public function removeNews(News $news)
    {
        $this->news->removeElement($news);
    }

    public function getNews()
    {
        return $this->news;
    }

    public function addPhone(Phone $phone)
    {
        $phone->setSchool($this);
        $this->phones[] = $phone;
    }

    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
