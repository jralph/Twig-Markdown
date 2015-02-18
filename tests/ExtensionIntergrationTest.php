<?php

use Jralph\Twig\Markdown\Extension;
use Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;

class ExtensionIntergrationTest extends Twig_Test_IntegrationTestCase {

    public function getExtensions()
    {
        return [
            new Extension(new ParsedownExtraMarkdown(new ParsedownExtra))
        ];
    }

    public function getFixturesDir()
    {
        return dirname(__FILE__).'/Fixtures/';
    }

}