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


    /**
     * @dataProvider provideTestData
     */
    public function test(array $rawConfig, ?string $expectedExceptionType): void
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
