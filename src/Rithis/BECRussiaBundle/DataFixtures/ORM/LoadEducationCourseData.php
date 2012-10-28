<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\EducationCourse;

class LoadEducationCourseData extends AbstractFixture
{
    static private $types = array('dietiam', 'podrostkam', 'vzroslym', 'kompaniiam');

    public function load(ObjectManager $manager)
    {
        foreach (self::$types as $key) {
            $type = $this->getReference(sprintf('education-course-type-%s', $key));

            $course = new EducationCourse();
            $course->setTitle($type->getTitle());
            $course->setAnnotation($type->getDescription());
            $course->setDescription($type->getDescription());
            $course->setImage($this->getMedia(sprintf('education-course-type-%s.jpg', $key), 'education_course'));
            $course->setType($type);
            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
