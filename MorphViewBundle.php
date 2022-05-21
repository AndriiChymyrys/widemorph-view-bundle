<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DependencyInjection\MorphViewExtension;

class MorphViewBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MorphViewExtension();
    }
}
