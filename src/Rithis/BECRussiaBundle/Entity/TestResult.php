<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\TestResultRepository")
 * @ORM\Table("test_results")
 */
class TestResult
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="test_results_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $title;

    /**
     * @ORM\Column("minimal_points", type="integer")
     */
    protected $minimalPoints;

    /**
     * @ORM\Column(type="text")
     */
    protected $result;

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

    public function __toString()
    {
        return $this->getResult();
    }
}
