<?php namespace Jralph\Twig\Markdown\Parsedown;

use Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;
use ParsedownExtra;

class ParsedownExtraMarkdown implements Markdown {

    /**
     * An instance of parsedown extra to use.
     *
     * @var ParsedownExtra
     */
    protected $parsedown;

    public function __construct(ParsedownExtra $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    /**
     * Parse the provided markdown text.
     *
     * @param  string $text
     * @return string
     */
    public function parse($text)
    {
        return $this->parsedown->parse($text);
    }

}
