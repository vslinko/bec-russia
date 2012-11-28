<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table("test_questions")
 */
class TestQuestion
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="test_questions_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $question;

    /**
     * @ORM\OneToMany(targetEntity="TestAnswer", mappedBy="question", cascade={"persist"})
     * @Assert\Valid
     */
    protected $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function addAnswer(TestAnswer $answer)
    {
        $answer->setQuestion($this);
        $this->answers[] = $answer;
    }

    public function removeAnswer(TestAnswer $answer)
    {
        $this->answers->removeElement($answer);
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function __toString()
    {
        return $this->getQuestion();
    }
}
