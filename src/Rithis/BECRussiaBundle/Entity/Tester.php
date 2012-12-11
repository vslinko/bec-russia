<?php

namespace Rithis\BECRussiaBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table("testers")
 */
class Tester
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="polls_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $age;

    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = "3")
     */
    protected $firstname;
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = "3")
     */
    protected $lastname;

    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min = "5")
     */
    protected $phone;
    
    /**
     * @ORM\Column(length=254)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    protected $email;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
