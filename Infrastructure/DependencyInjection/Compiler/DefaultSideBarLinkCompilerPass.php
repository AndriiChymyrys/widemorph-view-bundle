<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\SideBarLink;

/**
 * Class DefaultSideBarLinkCompilerPass
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler
 */
class DefaultSideBarLinkCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $container
            ->getDefinition(SideBarLink::class)
            ->addMethodCall('addLink', ['System', 'System', -1000, true]);
    }
}
