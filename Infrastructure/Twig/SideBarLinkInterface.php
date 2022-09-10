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
     * @param string $name
     * @param string $label
     * @param int $priority
     * @param bool $isCategory
     * @param string|null $parentName
     *
     * @return void
     */
    public function addLink(
        string $name,
        string $label,
        int $priority = 0,
        bool $isCategory = false,
        ?string $parentName = null
    ): void;

    /**
     * @return array
     */
    public function getMenuLinks(): array;
}
