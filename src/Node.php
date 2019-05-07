<?php namespace Jralph\Twig\Markdown;

use Twig\Compiler;
use Twig\Node\Node as TwigNode;

class Node extends TwigNode
{
    /**
     * Node constructor.
     * @param TwigNode $value
     * @param int $line
     * @param null $tag
     */
    public function __construct(TwigNode $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], ['name' => $tag], $line, $tag);
    }

    /**
     * Compile the provided markdown into html.
     *
     * @param  Compiler $compiler
     * @return void
     */
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this)
                 ->write('ob_start();' . PHP_EOL)
                 ->subcompile($this->getNode('value'))
                 ->write('$content = ob_get_clean();' . PHP_EOL)
                 ->write('preg_match("/^\s*/", $content, $matches);' . PHP_EOL)
                 ->write('$lines = explode("\n", $content);'.PHP_EOL)
                 ->write('$content = preg_replace(\'/^\' . $matches[0]. \'/\', "", $lines);' . PHP_EOL)
                 ->write('$content = implode("\n", $content);' . PHP_EOL)
                 ->write('echo $this->env->getTags()["markdown"]
                                    ->getMarkdown()
                                    ->parse($content);
                '.PHP_EOL);
    }

}
