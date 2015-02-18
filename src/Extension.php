<?php namespace Jralph\Twig\Markdown;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;
use Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class Extension extends Twig_Extension {

    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    public function getName()
    {
        return 'markdown';
    }

    public function getGlobals()
    {
        return [
            'markdown' => $this->markdown
        ];
    }

    public function getFilters()
    {
        return [
            'markdown' => new Twig_Filter_Method($this, 'parseMarkdown', ['is_safe' => ['html']])
        ];
    }

    public function getFunctions()
    {
        return [
            'markdown' => new Twig_Function_Method($this, 'parseMarkdown', ['is_safe' => ['html']])
        ];
    }

    public function getTokenParsers()
    {
        return [
            new TokenParser($this->markdown)
        ];
    }

    public function parseMarkdown($text)
    {
        return $this->markdown->parse($text);
    }

}
