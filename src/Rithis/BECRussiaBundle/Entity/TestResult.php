<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\TestResultRepository")
 * @ORM\Table("test_results")
 */
class TestResult
{
    const TYPE_BEGINNER = 'Beginner';
    const TYPE_ELEMENTARY = 'Elementary';
    const TYPE_PRE_INTERMEDIATE = 'Pre-intermediate';
    const TYPE_INTERMEDIATE = 'Intermediate';
    const TYPE_UPPER_INTERMEDIATE = 'Upper intermediate';
    const TYPE_ADVANCED = 'Advanced';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="test_results_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @ORM\Column("minimal_points", type="integer")
     * @Assert\NotBlank
     */
    protected $minimalPoints;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $result;

    /**
     * @ORM\Column(length=32)
     * @Assert\NotBlank
     */
    protected $type;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setMinimalPoints($minimalPoints)
    {
        $this->minimalPoints = $minimalPoints;
    }

    public function getMinimalPoints()
    {
        return $this->minimalPoints;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->getResult();
    }
}
