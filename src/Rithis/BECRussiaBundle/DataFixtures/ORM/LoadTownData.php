<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\Town;

class LoadTownData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $town = new Town();
        $town->setName('Железнодорожный');
        $this->setReference('town-zhielieznodorozhnyi', $town);
        $manager->persist($town);

        $town = new Town();
        $town->setName('Якутск');
        $this->setReference('town-iakutsk', $town);
        $manager->persist($town);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
