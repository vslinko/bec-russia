<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\EducationCourseType;

class LoadEducationCourseTypeData extends AbstractFixture
{
    static private $types = array(
        'dietiam' => array('Детям', 'от 4 до 13 лет', 'children'),
        'podrostkam' => array('Подросткам', 'от 14 до 17 лет', 'teenager'),
        'vzroslym' => array('Взрослым', 'от 18 лет', 'adult'),
        'kompaniiam' => array('Компаниям', 'корпоративное обучение', null),
    );

    public function load(ObjectManager $manager)
    {
        $position = 0;
        foreach (self::$types as $key => $texts) {
            list($title, $note, $age) = $texts;

            $type = new EducationCourseType();
            $type->setTitle($title);
            $type->setNote($note);
            $type->setAge($age);
            $type->setDescription($this->getContent(sprintf('education-course-type-%s.txt', $key)));
            $type->setImage($this->getMedia(sprintf('education-course-type-%s.jpg', $key), 'ed_course_type'));
            $this->setReference(sprintf('education-course-type-%s', $key), $type);
            $couser->setPosition($position);
            $manager->persist($type);
            
            $position++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
