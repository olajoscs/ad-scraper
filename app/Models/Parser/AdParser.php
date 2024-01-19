<?php

declare(strict_types=1);

namespace App\Models\Parser;

use App\Models\Config\Models\ParsedConfig;
use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Models\ParseConfigurationContainer;
use App\Models\Product\Models\ParsedProductCollection;

class AdParser
{
    public function __construct(
        private readonly ParseConfigurationContainer $parseConfigurationContainer
    )
    {
    }


    public function parse(ParsedConfig $config): void
    {
        $parsedProductCollection = new ParsedProductCollection();

        foreach ($config->parsedSiteConfigs as $parsedSiteConfig) {
            $paredProducts = $this->parseSite($parsedSiteConfig);

            $parsedProductCollection->addFromCollection($paredProducts);
        }

        $this->saveParsedProducts($parsedProductCollection);
    }


    private function parseSite(ParsedSiteConfig $parsedSiteConfig): ParsedProductCollection
    {
        $parsedProductCollection = $this->parseProducts($parsedSiteConfig);

        return $parsedProductCollection;
    }


    private function saveParsedProducts(ParsedProductCollection $parsedProductCollection): void
    {

    }


    private function parseProducts(ParsedSiteConfig $parsedSiteConfig): ParsedProductCollection
    {
        $finalResults = new ParsedProductCollection();

        foreach ($parsedSiteConfig->filters as $filter) {
            $results = $this->parseProductsForOneFilter($parsedSiteConfig, $filter);

            $finalResults->addFromCollection($results);
        }

        return $finalResults;
    }


    private function parseProductsForOneFilter(ParsedSiteConfig $parsedSiteConfig, string $filter)
    {
        $parserConfiguration = $this->parseConfigurationContainer->getParserConfiguration($parsedSiteConfig->key);
        $pageNumber = 1;

        while (true) {
            $html = $parserConfiguration->getHtmlScraper()->scrapeHtml($parsedSiteConfig, $filter, $pageNumber);

            $result = $parserConfiguration->getParser()->parse($html, $parsedSiteConfig);

            if (!$result->hasNextPage()) {
                break;
            }

            $pageNumber++;
        }

        return $result;
    }
}
