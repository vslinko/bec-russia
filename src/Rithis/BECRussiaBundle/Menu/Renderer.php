<?php

namespace Rithis\BECRussiaBundle\Menu;

use Knp\Menu\Renderer\RendererInterface,
    Knp\Menu\ItemInterface;

use Twig_Environment;

class Renderer implements RendererInterface
{
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(ItemInterface $item, array $options = array())
    {
        if ($options['footer']) {
            return $this->twig->render('RithisBECRussiaBundle::footer_menu.html.twig', array(
                'item' => $item,
                'options' => $options
            ));
        } else {
            return $this->twig->render('RithisBECRussiaBundle::menu.html.twig', array(
                'item' => $item,
                'options' => $options
            ));
        }
    }
}
