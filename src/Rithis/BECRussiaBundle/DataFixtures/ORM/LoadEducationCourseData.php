<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\EducationCourse,
    Rithis\BECRussiaBundle\Entity\TestResult;

class LoadEducationCourseData extends AbstractFixture
{
    static private $types = array(
        'dietiam' => array('Улучшить успеваемость в школе', 'Утро', TestResult::TYPE_BEGINNER),
        'podrostkam' => array('Повысить уровень знания английского языка', 'День', TestResult::TYPE_PRE_INTERMEDIATE),
        'vzroslym' => array('Для путешествий по миру', 'Только вечер', TestResult::TYPE_UPPER_INTERMEDIATE),
        'kompaniiam' => array('Для работы', 'Только выходные', TestResult::TYPE_ADVANCED),
    );

    public function load(ObjectManager $manager)
    {
        foreach (self::$types as $key => $texts) {
            list($reason, $schedule, $languageLevel) = $texts;

            $type = $this->getReference(sprintf('education-course-type-%s', $key));

            $course = new EducationCourse();
            $course->setTitle($type->getTitle());
            $course->setAnnotation($type->getDescription());
            $course->setDescription($type->getDescription());
            $course->setReason($reason);
            $course->setSchedule($schedule);
            $course->setLanguageLevel($languageLevel);
            $course->setImage($this->getMedia(sprintf('education-course-type-%s.jpg', $key), 'education_course'));
            $course->setType($type);
            $course->addSchool($this->getReference('school-zhielieznodorozhnyi'));
            $course->addSchool($this->getReference('school-iakutsk'));
            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
