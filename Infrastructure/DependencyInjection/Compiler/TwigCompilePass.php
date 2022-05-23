<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\SideBarLink;

/**
 * Class TwigCompilePass
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compile
 */
class TwigCompilePass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('twig')
            ->addMethodCall('addGlobal', ['side_bar_links', new Reference(SideBarLink::class)]);
    }
}
