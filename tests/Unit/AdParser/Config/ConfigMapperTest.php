<?php

declare(strict_types=1);

namespace AdParser\Config;

use App\Models\Config\Exceptions\MissingConfigPropertyException;
use App\Models\Config\Services\ConfigMapper;
use Tests\TestCase;

class ConfigMapperTest extends TestCase
{
    /**
     * @var ConfigMapper
     */
    private $configMapper;


    public function testPropertyValues(): void
    {
        $key1 = 'test1';
        $name1 = 'test1';
        $url1 = 'test1';
        $recipients1 = ['test1', 'test1'];
        $filters1 = ['test1', 'test1'];
        $exclusions1 = ['test1', 'test1'];

        $key2 = 'test2';
        $name2 = 'test2';
        $url2 = 'test2';
        $recipients2 = ['test2', 'test2'];
        $filters2 = ['test2', 'test2'];
        $exclusions2 = ['test2', 'test2'];

        $config = [
            'config' => [
                [
                    'key' => $key1,
                    'name' => $name1,
                    'url' => $url1,
                    'recipients' => $recipients1,
                    'filters' => $filters1,
                    'exclusions' => $exclusions1,
                ],
                [
                    'key' => $key2,
                    'name' => $name2,
                    'url' => $url2,
                    'recipients' => $recipients2,
                    'filters' => $filters2,
                    'exclusions' => $exclusions2,
                ],
            ],
        ];

        $parsedConfig = $this->configMapper->map($config);

        $this->assertCount(2, $parsedConfig->parsedSiteConfigs);
        $siteConfig1 = $parsedConfig->parsedSiteConfigs[0];
        $siteConfig2 = $parsedConfig->parsedSiteConfigs[1];

        $this->assertSame($key1, $siteConfig1->key);
        $this->assertSame($name1, $siteConfig1->name);
        $this->assertSame($url1, $siteConfig1->siteUrl);
        $this->assertSame($recipients1, $siteConfig1->recipients);
        $this->assertSame($filters1, $siteConfig1->filters);
        $this->assertSame($exclusions1, $siteConfig1->exclusionFilters);

        $this->assertSame($key2, $siteConfig2->key);
        $this->assertSame($name2, $siteConfig2->name);
        $this->assertSame($url2, $siteConfig2->siteUrl);
        $this->assertSame($recipients2, $siteConfig2->recipients);
        $this->assertSame($filters2, $siteConfig2->filters);
        $this->assertSame($exclusions2, $siteConfig2->exclusionFilters);
    }


    /**
     * @dataProvider provideTestData
     */
    public function testMissingProperties(array $rawConfig, ?string $expectedExceptionType): void
    {
        if ($expectedExceptionType) {
            $this->expectException($expectedExceptionType);
        }

        $this->configMapper->map($rawConfig);

        $this->assertTrue(true);
    }


    public static function provideTestData(): array
    {
        return [
            'everything ok' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'name' => 'test',
                        'url' => 'test',
                        'recipients' => ['test', 'test'],
                        'filters' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => null,
            ],

            'missing key' => [
                'rawConfig' => [
                    'config' => [[
                        'name' => 'test',
                        'url' => 'test',
                        'recipients' => ['test', 'test'],
                        'filters' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => MissingConfigPropertyException::class,
            ],

            'missing name' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'url' => 'test',
                        'recipients' => ['test', 'test'],
                        'filters' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => MissingConfigPropertyException::class,
            ],

            'missing url' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'name' => 'test',
                        'recipients' => ['test', 'test'],
                        'filters' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => MissingConfigPropertyException::class,
            ],

            'missing recipients' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'name' => 'test',
                        'url' => 'test',
                        'filters' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => MissingConfigPropertyException::class,
            ],

            'missing filters' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'name' => 'test',
                        'url' => 'test',
                        'recipients' => ['test', 'test'],
                        'exclusions' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => MissingConfigPropertyException::class,
            ],

            'missing exclusions' => [
                'rawConfig' => [
                    'config' => [[
                        'key' => 'test',
                        'name' => 'test',
                        'url' => 'test',
                        'recipients' => ['test', 'test'],
                        'filters' => ['test', 'test'],
                    ]],
                ],
                'expectedExceptionType' => null,
            ],
        ];
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->configMapper = new ConfigMapper();
    }
}
