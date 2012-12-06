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
            'for-teachers' => 'Information for teachers',
            'for-teachers/about' => 'About BEC',
            'for-teachers/cities' => 'Cities of BEC',
            'for-teachers/teachers' => 'Teachers',
            'for-teachers/application' => 'Application Form',
            'for-teachers/downloads' => 'Downloads',
            'for-teachers/contract' => 'Contract',
            'for-teachers/instructions' => 'Instructions',
            'for-teachers/rules' => 'Rules of BEC',
        );

        foreach ($fake as $key => $title) {
            $page = new Page();
            $page->setSecretKey($key);
            $page->setUri($key);
            $page->setTitle($title);

            if ($this->hasContent($key . '.html')) {
                $page->setContent($this->getContent($key . '.html'));
            } else {
                $page->setContent($title);
            }

            $manager->persist($page);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
