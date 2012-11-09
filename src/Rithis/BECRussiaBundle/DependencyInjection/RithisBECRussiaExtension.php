<?php

namespace Rithis\BECRussiaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader,
    Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Config\FileLocator;

class RithisBECRussiaExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('admin.yml');
        $loader->load('form.yml');
        $loader->load('twig.yml');
        $loader->load('doctrine.yml');
    }
}
