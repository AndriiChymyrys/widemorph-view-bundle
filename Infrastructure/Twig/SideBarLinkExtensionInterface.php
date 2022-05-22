<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO\SideBarLinkDTO;

/**
 * Class SideBarLinkExtensionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
interface SideBarLinkExtensionInterface
{
    /**
     * @param SideBarLinkDTO $barLinkDTO
     *
     * @return void
     */
    public function addLink(SideBarLinkDTO $barLinkDTO): void;

    /**
     * @return array
     */
    public function getMenuLinks(): array;
}
