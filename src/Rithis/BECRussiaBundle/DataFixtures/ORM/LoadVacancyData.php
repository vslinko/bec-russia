<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\Vacancy;

class LoadVacancyData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $vacancy = new Vacancy();
        $vacancy->setTitle('Хозяин/Хозяйка чайного клуба');
        $vacancy->setAnnotation($this->getContent('vacancy-annotation.txt'));
        $vacancy->setDescription($this->getContent('vacancy-description.html'));
        $vacancy->setSchool($this->getReference('school-zhielieznodorozhnyi'));
        $manager->persist($vacancy);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
