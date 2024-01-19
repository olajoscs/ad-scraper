<?php

declare(strict_types=1);

namespace AdParser\Parser;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Models\ParseConfiguration;
use App\Models\Parser\Models\ParseConfigurationContainer;
use App\Models\Parser\Services\HtmlScraper;
use App\Models\Parser\Services\Parser;
use App\Models\Product\Models\ParsedProductCollection;
use PHPUnit\Framework\TestCase;

class ParserConfigurationContainerTest extends TestCase
{
    private const TEST_KEY = 'test-key';


    public function testGetter(): void
    {
        $configuration = $this->createConfiguration();

        $container = new ParseConfigurationContainer([$configuration]);

        $this->assertSame($configuration, $container->getParserConfiguration(self::TEST_KEY));
        $this->assertSame([$configuration], $container->getParseConfigurations());
    }


    private function createConfiguration(): ParseConfiguration
    {
        $parser = $this->createParser();
        $htmlScrpaer = $this->createHtmlScraper();

        return new class (self::TEST_KEY, $parser, $htmlScrpaer) implements ParseConfiguration {

            public function __construct(
                private readonly string $testKey,
                private readonly Parser $parser,
                private readonly HtmlScraper $htmlScraper,
            )
            {
            }


            public function getKey(): string
            {
                return $this->testKey;
            }


            public function getParser(): Parser
            {
                return $this->parser;
            }


            public function getHtmlScraper(): HtmlScraper
            {
                return $this->htmlScraper;
            }
        };
    }


    private function createParser(): Parser
    {
        return new class implements Parser {
            public function parse(string $html, ParsedSiteConfig $parsedSiteConfig): ParsedProductCollection
            {
                return new ParsedProductCollection();
            }
        };
    }


    private function createHtmlScraper(): HtmlScraper
    {
        return new class implements HtmlScraper {
            public function scrapeHtml(ParsedSiteConfig $parsedSiteConfig, string $filter, int $pageNumber): string
            {
                return '';
            }
        };
    }
}
