<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("poll_answers")
 */
class PollAnswer
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
     */
    protected $answer;

    /**
     * @ORM\Column(type="integer")
     */
    protected $count = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Poll", inversedBy="answers")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    protected $poll;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAnswer($question)
    {
        $this->answer = $question;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function incrementCount()
    {
        $this->count++;
    }

    public function setPoll($poll)
    {
        $this->poll = $poll;
    }

    public function getPoll()
    {
        return $this->poll;
    }

    public function __toString()
    {
        return $this->getAnswer();
    }
}
