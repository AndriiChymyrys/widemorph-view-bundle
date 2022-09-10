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
     * @param string $name
     * @param string $label
     * @param int $priority
     * @param bool $isCategory
     * @param string|null $parentName
     */
    public function __construct(
        protected string $name,
        protected string $label,
        protected int $priority = 0,
        protected bool $isCategory = false,
        protected ?string $parentName = null
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return bool
     */
    public function isCategory(): bool
    {
        return $this->isCategory;
    }

    #[ArrayShape(['priority' => "int", 'label' => "string", 'name' => "string"])]
    public function getLink(): array
    {
        return [
            'priority' => $this->getPriority(),
            'label' => $this->getLabel(),
            'name' => $this->getName(),
        ];
    }
}
