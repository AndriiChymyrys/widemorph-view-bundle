<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO\SideBarLinkDTO;

/**
 * Class SideBarLinkExtension
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
class SideBarLinkExtension implements SideBarLinkExtensionInterface
{
    /**
     * @var SideBarLinkDTO[]
     */
    protected array $links = [];

    /**
     * {@inheritDoc}
     */
    public function addLink(SideBarLinkDTO $barLinkDTO): void
    {
        $this->links[] = $barLinkDTO;
    }

    /**
     * {@inheritDoc}
     */
    public function getMenuLinks(): array
    {
        $links = [];

        // support only one level nesting
        foreach ($this->links as $link) {
            if ($link->getParentRoute()) {
                if (!isset($links[$link->getParentRoute()])) {
                    $links[$link->getParentRoute()]['children'] = [];
                }

                $links[$link->getParentRoute()]['children'][] = $link->getLink();
            } else {
                $links[$link->getRouteName()] = $link->getLink();
            }
        }

        return $links;
    }
}
