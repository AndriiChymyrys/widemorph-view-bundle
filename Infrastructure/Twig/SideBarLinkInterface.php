<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

/**
 * Class SideBarLinkExtensionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
interface SideBarLinkInterface
{
    /**
     * @param string $routeName
     * @param string $label
     * @param int $priority
     * @param string|null $parentRouteName
     *
     * @return void
     */
    public function addLink(
        string $routeName,
        string $label,
        int $priority = 0,
        ?string $parentRouteName = null
    ): void;

    /**
     * @return array
     */
    public function getMenuLinks(): array;
}
