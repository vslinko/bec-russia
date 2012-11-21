<?php

namespace Rithis\BECRussiaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader,
    Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Config\Definition\Processor,
    Symfony\Component\Config\FileLocator;

class RithisBECRussiaExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor     = new Processor();
        $configuration = new Configuration();
        $config        = $processor->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('admin.yml');
        $loader->load('form.yml');
        $loader->load('twig.yml');
        $loader->load('doctrine.yml');
        $loader->load('unisender.yml');
        $loader->load('provider.yml');
        $loader->load('menu.yml');

        foreach ($config['library'] as $name => $providerConfigs) {
            $provider = 'rithis.becrussia.library.provider.' . $name;
            if ($container->hasDefinition($provider)) {
                $definition = $container->getDefinition($provider);
                $definition->replaceArgument(5, $providerConfigs['allowed_extensions']);
                $definition->replaceArgument(6, $providerConfigs['allowed_mime_types']);
            }
        }
    }
}
