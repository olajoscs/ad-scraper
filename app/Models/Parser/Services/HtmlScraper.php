<?php

declare(strict_types=1);

namespace App\Models\Parser\Services;

use App\Models\Config\Models\ParsedSiteConfig;

interface HtmlScraper
{
    public function scrapeHtml(ParsedSiteConfig $parsedSiteConfig, string $filter, int $pageNumber): string;
}
