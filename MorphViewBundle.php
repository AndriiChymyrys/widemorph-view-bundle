<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\MorphViewExtension;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler\TwigCompilePass;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler\DefaultSideBarLinkCompilerPass;

/**
 * Class MorphViewBundle
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle
 */
class MorphViewBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new TwigCompilePass());
        $container->addCompilerPass(new DefaultSideBarLinkCompilerPass());
    }

    /**
     * {@inheritDoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MorphViewExtension();
    }
}
