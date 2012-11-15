<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\School;

class LoadSchoolData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $school = new School();
        $school->setTitle('Центральный офис');
        $school->setAddress('улица Пролетарская, дом 7');
        $school->setAbout($this->getContent('school-zhielieznodorozhnyi-about.html'));
        $school->setDiscounts($this->getContent('school-discounts.html'));
        $school->setImage($this->getMedia('school-zhielieznodorozhnyi-image.gif', 'school'));
        $school->setTown($this->getReference('town-zhielieznodorozhnyi'));
        $this->addPhones($school, array(
            '+7 (495) 514-23-76' => array(true, true),
            '+7 (495) 640-44-80' => array(true, false),
            '+7 (498) 304-22-40' => array(true, false),
            '+7 (498) 304-22-41' => array(false, false),
        ));
        $this->setReference('school-zhielieznodorozhnyi', $school);
        $manager->persist($school);

        $school = new School();
        $school->setTitle('Филиал в Якутске');
        $school->setAddress('улица Петровского, дом 8/1');
        $school->setAbout($this->getContent('school-iakutsk-about.html'));
        $school->setDiscounts($this->getContent('school-discounts.html'));
        $school->setImage($this->getMedia('school-iakutsk-image.gif', 'school'));
        $school->setTown($this->getReference('town-iakutsk'));
        $this->addPhones($school, array(
            '+7 (4112) 25-20-55 ' => array(true, false),
        ));
        $this->setReference('school-iakutsk', $school);
        $manager->persist($school);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
