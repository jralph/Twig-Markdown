<?php namespace Jralph\Twig\Markdown;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Jralph\Twig\Markdown\Contracts\MarkdownInterface as Markdown;

class Extension extends AbstractExtension implements GlobalsInterface {

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
     * Return the name of the extension.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'markdown';
    }

    /**
     * Setup the twig globals.
     *
     * @return array
     */
    public function getGlobals(): array
    {
        return [
            'markdown' => $this->markdown
        ];
    }

    /**
     * Setup the twig filters.
     *
     * @return array
     */
    public function getFilters(): array
    {
        return [
            'markdown' => new TwigFilter('markdown', [$this, 'parseMarkdown'], ['is_safe' => ['all']]),
        ];
    }

    /**
     * Setup the twig functions.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            'markdown' => new TwigFunction('markdown', [$this, 'parseMarkdown'], ['is_safe' => ['all']])
        ];
    }

    /**
     * Setup twig tags.
     *
     * @return array
     */
    public function getTokenParsers(): array
    {
        return [
            new TokenParser($this->markdown)
        ];
    }

    /**
     * Helper method for parsing markdown.
     *
     * @param  string $text
     * @return string
     */
    public function parseMarkdown($text): string
    {
        return $this->markdown->parse($text);
    }

}
