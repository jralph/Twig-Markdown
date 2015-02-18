<?php namespace Jralph\Twig\Markdown\Parsedown;

use Jralph\Twig\Markdown\Contracts\Markdown;
use ParsedownExtra;

class ParsedownExtraMarkdown implements Markdown {

    protected $parsedown;

    public function __construct(ParsedownExtra $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    public function parse($text)
    {
        return $this->parsedown->parse($text);
    }

}
