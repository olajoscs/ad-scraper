<?php

declare(strict_types=1);

namespace App\Models\Config\Models;

class ParsedSiteConfig
{
    public string $key;
    public string $name;
    public string $siteUrl;
    public array $recipients;
    public array $filters;
    public array $exclusionFilters;
}
