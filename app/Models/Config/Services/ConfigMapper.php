<?php

declare(strict_types=1);

namespace App\Models\Config\Services;

use App\Models\Config\Exceptions\MissingConfigPropertyException;
use App\Models\Config\Models\ParsedConfig;
use App\Models\Config\Models\ParsedSiteConfig;

class ConfigMapper
{
    public function map(array $rawConfig): ParsedConfig
    {
        $parsedSiteConfigs = array_map(
            fn($siteConfig) => $this->mapConfig($siteConfig),
            $rawConfig['config']
        );

        return new ParsedConfig($parsedSiteConfigs);
    }


    private function mapConfig(array $siteConfig): ParsedSiteConfig
    {
        $this->requireProperties($siteConfig);

        $parsedSiteConfig = new ParsedSiteConfig();

        $parsedSiteConfig->key = $siteConfig['key'];
        $parsedSiteConfig->name = $siteConfig['name'];
        $parsedSiteConfig->siteUrl = $siteConfig['url'];
        $parsedSiteConfig->recipients = $siteConfig['recipients'];
        $parsedSiteConfig->filters = $siteConfig['filters'];
        $parsedSiteConfig->exclusionFilters = $siteConfig['exclusions'] ?? [];

        return $parsedSiteConfig;
    }


    private function requireProperties(array $siteConfig): void
    {
        $mandatoryProperties = ['key', 'name', 'url', 'recipients', 'filters'];

        foreach ($mandatoryProperties as $mandatoryProperty) {
            if (!isset($siteConfig[$mandatoryProperty])) {
                throw new MissingConfigPropertyException('Property is missing: ' . $mandatoryProperty . ', config: ' . json_encode($siteConfig));
            }
        }
    }
}
