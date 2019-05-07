<?php namespace Jralph\Twig\Markdown;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class TokenParser extends AbstractTokenParser {

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
     * @param  Token $token
     * @return Node
     */
    public function parse(Token $token)
    {
        $line = $token->getLine();

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(function(Token $token) {
            return $token->test('endmarkdown');
        }, true);

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

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
