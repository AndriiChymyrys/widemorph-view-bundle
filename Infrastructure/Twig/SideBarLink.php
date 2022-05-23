<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO\SideBarLinkDTO;

/**
 * Class SideBarLinkExtension
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
class SideBarLink implements SideBarLinkInterface
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
        $links = $this->getLinkTree();

        $this->sortByPriority($links);

        foreach ($links as &$link) {
            if (isset($link['children']) && !empty($link['children'])) {
                $this->sortByPriority($link['children']);
            }
        }

        return $links;
    }

    /**
     * @return array
     */
    protected function getLinkTree(): array
    {
        $links = [];

        // support only one level nesting
        foreach ($this->links as $link) {
            if ($link->getParentRouteName()) {
                if (!isset($links[$link->getParentRouteName()])) {
                    $links[$link->getParentRouteName()]['children'] = [];
                }

                $links[$link->getParentRouteName()]['children'][] = $link->getLink();
            } else {
                $links[$link->getRouteName()] = $link->getLink();
            }
        }

        return $links;
    }

    /**
     * @param array $links
     *
     * @return void
     */
    protected function sortByPriority(array &$links): void
    {
        usort($links, static function ($a, $b) {
            if ($a['priority'] === $b['priority']) {
                return 0;
            }

            return ($a['priority'] > $b['priority']) ? -1 : 1;
        });
    }
}
