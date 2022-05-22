<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class MorphViewExtension
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection
 */
class MorphViewExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources/config')
        );

        $loader->load('presentation.xml');
        $loader->load('infrastructure.xml');
    }
}
