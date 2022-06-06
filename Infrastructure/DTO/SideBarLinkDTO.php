<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class SideBarLinkDTO
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO
 */
class SideBarLinkDTO
{
    /**
     * @param string $routeName
     * @param string $label
     * @param int $priority
     * @param string|null $parentRouteName
     */
    public function __construct(
        protected string $routeName,
        protected string $label,
        protected int $priority = 0,
        protected ?string $parentRouteName = null
    ) {
    }

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getParentRouteName(): ?string
    {
        return $this->parentRouteName;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    #[ArrayShape(['priority' => "int", 'label' => "string", 'routeName' => "string"])]
    public function getLink(): array
    {
        return [
            'priority' => $this->getPriority(),
            'label' => $this->getLabel(),
            'routeName' => $this->getRouteName(),
        ];
    }
}
