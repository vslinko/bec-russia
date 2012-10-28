<?php

namespace Rithis\BECRussiaBundle\Form\DataClass;

class EducationCourseSearch
{
    protected $age;
    protected $town;
    protected $reason;
    protected $schedule;
    protected $languageLevel;

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setTown($town)
    {
        $this->town = $town;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setLanguageLevel($languageLevel)
    {
        $this->languageLevel = $languageLevel;
    }

    public function getLanguageLevel()
    {
        return $this->languageLevel;
    }

    public function toArray()
    {
        return array(
            'age' => $this->getAge(),
            'town' => $this->getTown(),
            'reason' => $this->getReason(),
            'schedule' => $this->getSchedule(),
            'languageLevel' => $this->getLanguageLevel(),
        );
    }
}
