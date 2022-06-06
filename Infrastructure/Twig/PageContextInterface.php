<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

/**
 * Class PageContextInterface
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
interface PageContextInterface
{
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function setVar(string $name, mixed $value): void;

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getVar(string $name): mixed;
}
