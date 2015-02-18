<?php namespace Jralph\Twig\Markdown\Contracts;

interface MarkdownInterface {

    /**
     * Parse the provided markdown text.
     *
     * @param  string $text
     * @return string
     */
    public function parse($text);

}
