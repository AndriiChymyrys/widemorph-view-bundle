<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Class PageContextGetVarTokenParser
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\Tag\Variable
 */
class PageContextGetVarTokenParser extends AbstractTokenParser
{
    /**
     * {@inheritDoc}
     */
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $parser = $this->parser;
        $stream = $parser->getStream();
        $echo = false;

        if ($stream->look(0)->test(Token::PUNCTUATION_TYPE, '(')) {
            // use like {% pcvarget('page_title') %} then page_title var value will be in echo
            $stream->expect(Token::PUNCTUATION_TYPE, '(');
            $value = $stream->expect(Token::STRING_TYPE)->getValue();
            $stream->expect(Token::PUNCTUATION_TYPE, ')');
            $echo = true;
        } else {
            // use like {% pcvarget.page_title %} then page_title var will be in context
            $stream->expect(Token::PUNCTUATION_TYPE, '.');
            $value = $stream->expect(Token::NAME_TYPE)->getValue();
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new PageContextGetVarNode(['value' => $value, 'echo' => $echo], $lineno);
    }

    /**
     * {@inheritDoc}
     */
    public function getTag(): string
    {
        return 'pcvarget';
    }
}
