<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("test_answers")
 */
class TestAnswer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="test_answers_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=140)
     * @Assert\NotBlank
     */
    protected $answer;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    protected $points;

    /**
     * @ORM\ManyToOne(targetEntity="TestQuestion", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank
     */
    protected $question;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function __toString()
    {
        return $this->getAnswer();
    }
}
