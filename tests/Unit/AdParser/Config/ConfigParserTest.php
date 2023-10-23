<?php

declare(strict_types=1);

namespace AdParser\Config;

use App\Models\Config\Services\ConfigFileContentProvider;
use App\Models\Config\Services\ConfigMapper;
use App\Models\Config\Services\ConfigParser;
use PHPUnit\Framework\TestCase;

class ConfigParserTest extends TestCase
{
    public function testParsing(): void
    {
        $key = 'test';
        $name = 'test';
        $url = 'test';
        $recipients = ['test', 'test'];
        $filters = ['test', 'test'];
        $exclusions = ['test', 'test'];

        $configFileContentProvider = $this->createMock(ConfigFileContentProvider::class);

        $configFileContentProvider->method('provideConfigFileContent')->willReturn([
            'config' => [[
                'key' => $key,
                'name' => $name,
                'url' => $url,
                'recipients' => $recipients,
                'filters' => $filters,
                'exclusions' => $exclusions,
            ]]
        ]);

        $configParser = new ConfigParser(
            new ConfigMapper(),
            $configFileContentProvider
        );

        $parsedConfig = $configParser->parseConfig();

        $this->assertCount(1, $parsedConfig->siteConfigs);
        $siteConfig = $parsedConfig->siteConfigs[0];

        $this->assertSame($key, $siteConfig->key);
        $this->assertSame($name, $siteConfig->name);
        $this->assertSame($url, $siteConfig->siteUrl);
        $this->assertSame($recipients, $siteConfig->recipients);
        $this->assertSame($filters, $siteConfig->filters);
        $this->assertSame($exclusions, $siteConfig->exclusionFilters);
    }
}
