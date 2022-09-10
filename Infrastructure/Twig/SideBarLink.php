<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO\SideBarLinkDTO;

/**
 * Class SideBarLinkExtension
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
class SideBarLink implements SideBarLinkInterface
{
    /**
     * @var Request|null
     */
    protected ?Request $request;

    /**
     * @var string|null
     */
    protected ?string $currentRoute;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param RequestStack $requestStack
     */
    public function __construct(protected UrlGeneratorInterface $urlGenerator, RequestStack $requestStack)
    {
        $this->request = $requestStack->getMainRequest();
        $this->currentRoute = $this->request?->get('_route');
    }

    /**
     * @var SideBarLinkDTO[]
     */
    protected array $links = [];

    /**
     * {@inheritDoc}
     */
    public function addLink(
        string $name,
        string $label,
        int $priority = 0,
        bool $isCategory = false,
        ?string $parentName = null
    ): void {
        $this->links[] = new SideBarLinkDTO($name, $label, $priority, $isCategory, $parentName);
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
            if ($link->getParentName()) {
                if (!isset($links[$link->getParentName()])) {
                    $links[$link->getParentName()]['children'] = [];
                }

                $links[$link->getParentName()]['children'][] = $this->getLink($link);
            } else {
                $links[$link->getName()] = $this->getLink($link);
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

    /**
     * @param SideBarLinkDTO $linkDTO
     *
     * @return array
     */
    #[ArrayShape([
        'priority' => "int",
        'label' => "string",
        'name' => "string",
        'isActive' => "bool",
        'route' => "string"
    ])]
    protected function getLink(SideBarLinkDTO $linkDTO): array
    {
        $linkArray = $linkDTO->getLink();

        if (!$linkDTO->isCategory()) {
            $linkArray['route'] = $this->urlGenerator->generate($linkDTO->getName());
        }

        $linkArray['isActive'] = $this->currentRoute === $linkDTO->getName();

        return $linkArray;
    }
}
