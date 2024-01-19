<?php

declare(strict_types=1);

namespace App\Models\Parser\Services\Jofogas;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Services\HtmlScraper;
use App\Models\Parser\Services\UrlGenerator;

class JofogasHtmlScraper implements HtmlScraper
{
    public function __construct(private readonly UrlGenerator $urlGenerator)
    {
    }


    public function scrapeHtml(ParsedSiteConfig $parsedSiteConfig, string $filter, int $pageNumber): string
    {
        $url = $this->urlGenerator->generate($parsedSiteConfig, $filter, $pageNumber);

        $html = $this->getUrlContentHtmlAsString($url);

        return $html;
    }


    private function getUrlContentHtmlAsString($url): string
    {
        return file_get_contents($url);
    }
}
