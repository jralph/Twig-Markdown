<?php namespace Jralph\Twig\Markdown;

use Twig_TokenParser;
use Twig_Token;
use Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class TokenParser extends Twig_TokenParser {

    /**
     * An instance of a markdown processor to use.
     *
     * @var Markdown
     */
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Parse the twig tag.
     *
     * @param  Twig_Token $token
     * @return Node
     */
    public function parse(Twig_Token $token)
    {
        $line = $token->getLine();

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(function(Twig_Token $token)
        {
            return $token->test('endmarkdown');
        }, true);

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new Node($body, $line, $this->getTag());
    }

    /**
     * Return the name of the twig tag.
     *
     * @return string
     */
    public function getTag()
    {
        return 'markdown';
    }

    /**
     * Return the markdown instance being used.
     *
     * @return string
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }

}
