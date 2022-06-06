<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Class PageContextVarTokenParser
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable
 */
class PageContextSetVarTokenParser extends AbstractTokenParser
{
    /**
     * {@inheritDoc}
     */
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $parser = $this->parser;
        $stream = $parser->getStream();

        $stream->expect(Token::PUNCTUATION_TYPE, '(');
        $var = $stream->expect(Token::STRING_TYPE)->getValue();
        $stream->expect(Token::PUNCTUATION_TYPE, ',');
        $value = $this->parser->getExpressionParser()->parseMultitargetExpression();
        $stream->expect(Token::PUNCTUATION_TYPE, ')');
        $stream->expect(Token::BLOCK_END_TYPE);

        return new PageContextSetVarNode($var, $value, $lineno);
    }

    /**
     * {@inheritDoc}
     */
    public function getTag(): string
    {
        return 'pcvarset';
    }
}
