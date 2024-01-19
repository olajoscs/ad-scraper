<?php

declare(strict_types=1);

namespace App\Models\Parser\Services;

use App\Models\Config\Models\ParsedSiteConfig;

interface UrlGenerator
{
    public function generate(ParsedSiteConfig $parsedSiteConfig, string $filter, int $pageNumber);
}
