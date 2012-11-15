<?php

namespace Rithis\BECRussiaBundle\Menu;

use Symfony\Component\DependencyInjection\ContainerAware,
    Knp\Menu\FactoryInterface;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('О центре', array('route' => 'rithis_becrussia_index_get'));
        $menu->addChild('Школы', array('route' => 'rithis_becrussia_school_all'));
        $menu->addChild('Вакансии', array('route' => 'rithis_becrussia_vacancy_all'));
        $menu->addChild('Библиотека', array('route' => 'rithis_becrussia_library_library'));

        return $menu;
    }
}
