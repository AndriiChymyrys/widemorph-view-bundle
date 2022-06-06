<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable;

use Twig\Compiler;
use Twig\Node\Node;

/**
 * Class PageContextGetVarNode
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable
 */
class PageContextGetVarNode extends Node
{
    /**
     * @param array $attributes
     * @param $line
     * @param $tag
     */
    public function __construct(array $attributes, $line, $tag = null)
    {
        parent::__construct([], $attributes, $line, $tag);
    }

    /**
     * {@inheritDoc}
     */
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        if ($this->getAttribute('echo')) {
            $compiler->write('echo ');
        } else {
            $compiler->write(sprintf('$context[\'%s\'] = ', $this->getAttribute('value')));
        }

        $compiler->write(
            sprintf(
                '$this->env->getGlobals()[\'page_context\']->getVar(\'%s\');',
                $this->getAttribute('value'),
            )
        );
    }
}
