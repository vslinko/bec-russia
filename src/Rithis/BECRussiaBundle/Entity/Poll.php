<?php

namespace Rithis\BECRussiaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Rithis\BECRussiaBundle\Entity\PollRepository")
 * @ORM\Table("polls")
 */
class Poll
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="polls_id_seq")
     */
    protected $id;

    /**
     * @ORM\Column(length=140)
     * @Assert\NotBlank
     */
    protected $question;

    /**
     * @ORM\Column("created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="PollAnswer", mappedBy="poll", cascade={"persist"})
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

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function addAnswer(PollAnswer $answer)
    {
        $answer->setPoll($this);
        $this->answers[] = $answer;
    }

    public function removeAnswer(PollAnswer $answer)
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
