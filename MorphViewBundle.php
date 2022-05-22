<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\Compiler\TwigCompilePass;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\MorphViewExtension;

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
    }

    /**
     * {@inheritDoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MorphViewExtension();
    }
}
