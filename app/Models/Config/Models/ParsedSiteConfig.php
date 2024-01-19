<?php

declare(strict_types=1);

namespace App\Models\Config\Models;

class ParsedSiteConfig
{
    public string $key;
    public string $name;
    public string $siteUrl;

    /**
     * @var string[]
     */
    public array $recipients;

    /**
     * @var string[]
     */
    public array $filters;

    /**
     * @var string[]
     */
    public array $exclusionFilters;
}
