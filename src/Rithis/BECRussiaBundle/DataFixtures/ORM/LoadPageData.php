<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\Page;

class LoadPageData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setSecretKey('mainpage');
        $page->setTitle('История центра');
        $page->setContent($this->getContent('page-mainpage.html'));
        $manager->persist($page);

        $fake = array(
            'about_centre' => 'О центре',
            'methodology' => 'Методика',
            'franchising' => 'Франчайзинг',
            'press' => 'Пресса',
            'certificates' => 'Подарочные сертификаты',
        );

        foreach ($fake as $key => $title) {
            $page = new Page();
            $page->setSecretKey($key);
            $page->setUri($key);
            $page->setTitle($title);
            $page->setContent($title);
            $manager->persist($page);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
