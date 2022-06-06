<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable;

use Twig\Compiler;
use Twig\Node\Node;

/**
 * Class PageContextVarNode
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable
 */
class PageContextSetVarNode extends Node
{
    /**
     * @param $name
     * @param Node $value
     * @param $line
     * @param $tag
     */
    public function __construct($name, Node $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], ['name' => $name], $line, $tag);
    }

    /**
     * {@inheritDoc}
     */
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler
            ->write('ob_start();')
            ->raw(PHP_EOL);

        $compiler
            ->write('echo ')
            ->subcompile($this->getNode('value'))
            ->raw(';')
            ->raw(PHP_EOL);

        $compiler
            ->write('$_value = ob_get_clean();')
            ->raw(PHP_EOL);

        $compiler->write(
            sprintf(
                '$this->env->getGlobals()[\'page_context\']->setVar(\'%s\', $_value);',
                $this->getAttribute('name'),
            )
        );
    }
}
