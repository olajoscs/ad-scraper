<?php

declare(strict_types=1);

namespace App\Models\Parser\Services;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Product\Models\ParsedProductCollection;

interface Parser
{
    /**
     *
     *
     * @param string $html
     * @param ParsedSiteConfig $parsedSiteConfig
     *
     * @return ParsedProductCollection
     */
    public function parse(string $html, ParsedSiteConfig $parsedSiteConfig): ParsedProductCollection;
}
