<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\Teacher;

class LoadTeacherData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $teacher = new Teacher();
        $teacher->setName('Stephen Reeves');
        $teacher->setDescription($this->getContent('teacher-stephen-reeves.html'));
        $teacher->setImage($this->getMedia('teacher-stephen-reeves.jpg', 'teacher'));
        $teacher->setSchool($this->getReference('school-zhielieznodorozhnyi'));
        $manager->persist($teacher);

        $teacher = new Teacher();
        $teacher->setName('Daryl Grant Coetzer');
        $teacher->setDescription($this->getContent('teacher-daryl-grant-coetzer.html'));
        $teacher->setImage($this->getMedia('teacher-daryl-grant-coetzer.jpg', 'teacher'));
        $teacher->setSchool($this->getReference('school-iakutsk'));
        $manager->persist($teacher);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
