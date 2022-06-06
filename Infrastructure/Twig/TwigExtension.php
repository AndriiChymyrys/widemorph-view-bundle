<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable\PageContextGetVarTokenParser;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable\PageContextSetVarTokenParser;

/**
 * Class TwigExtension
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig
 */
class TwigExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return [
            new PageContextSetVarTokenParser(),
            new PageContextGetVarTokenParser(),
        ];
    }
}
