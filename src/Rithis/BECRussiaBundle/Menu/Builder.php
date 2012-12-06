<?php

namespace Rithis\BECRussiaBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerAware,
    Knp\Menu\FactoryInterface;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $em = $this->container->get('doctrine')->getManager();
        $keys = array(
            'about_centre',
            'methodology',
            'franchising',
            'press',
            'certificates',
            'for-teachers',
        );
        $pages = $em->getRepository('RithisBECRussiaBundle:Page')->findBy(array('secretKey' => $keys));
        $addChild = function ($key) use ($menu, $pages) {
            $pages = array_filter($pages, function ($page) use ($key) {
                return $page->getSecretKey() == $key;
            });

            if (count($pages) == 1) {
                $page = array_shift($pages);

                $menu->addChild($page->getTitle(), array('uri' => '/' . $page->getUri()));
            }
        };

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Главная', array('route' => 'rithis_becrussia_index_get'));
        $addChild('about_centre');
        $menu->addChild('Школы', array('route' => 'rithis_becrussia_school_all'));
        $addChild('methodology');
        $addChild('franchising');
        $addChild('press');
        $menu->addChild('Библиотека', array('route' => 'rithis_becrussia_library_library'));
        $addChild('certificates');
        $menu->addChild('Вакансии', array('route' => 'rithis_becrussia_vacancy_all'));
        $addChild('for-teachers');

        return $menu;
    }
}
