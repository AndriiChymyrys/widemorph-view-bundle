<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

/**
 * Class PageContext
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
class PageContext implements PageContextInterface
{
    /**
     * @var array
     */
    protected array $vars = [];

    /**
     * {@inheritDoc}
     */
    public function setVar(string $name, mixed $value): void
    {
        $this->vars[$name] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getVar(string $name): mixed
    {
        return $this->vars[$name] ?? null;
    }
}
