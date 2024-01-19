<?php

declare(strict_types=1);

namespace App\Models\Config\Models;

class ParsedConfig
{
    /**
     * @var ParsedSiteConfig[]
     */
    public readonly array $parsedSiteConfigs;


    public function __construct(array $siteConfigs)
    {
        $this->parsedSiteConfigs = $siteConfigs;
    }
}
