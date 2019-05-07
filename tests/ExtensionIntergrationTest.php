<?php

use Jralph\Twig\Markdown\Extension;
use Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;
use Twig\Test\IntegrationTestCase;

class ExtensionIntergrationTest extends IntegrationTestCase {

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