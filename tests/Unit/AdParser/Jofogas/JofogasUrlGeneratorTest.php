<?php

declare(strict_types=1);

namespace AdParser\Jofogas;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Exceptions\MissingFilterUrlGeneratorException;
use App\Models\Parser\Services\Jofogas\JofogasUrlGenerator;
use PHPUnit\Framework\TestCase;

class JofogasUrlGeneratorTest extends TestCase
{
    /**
     * @var JofogasUrlGenerator
     */
    private $urlGenerator;


    protected function setUp(): void
    {
        $this->urlGenerator = new JofogasUrlGenerator();
    }


    /**
     * @dataProvider urlDataProvider
     */
    public function testUrls(string $filter, int $pageNumber, ?string $expectedResult, ?string $excpectedException): void
    {
        $parsedSiteConfig = $this->createParsedSiteConfig();

        if ($excpectedException !== null) {
            $this->expectException($excpectedException);
        }

        $result = $this->urlGenerator->generate($parsedSiteConfig, $filter, $pageNumber);

        if ($excpectedException === null) {
            $this->assertSame($expectedResult, $result);
        }
    }


    public static function urlDataProvider(): array
    {
        return [
            'missing search term' => [
                'filter' => '',
                'pageNumber' => 0,
                'expectedResult' => null,
                'expectedException' => MissingFilterUrlGeneratorException::class,
            ],

            'single search term without page number' => [
                'filter' => 'ps4',
                'pageNumber' => 0,
                'expectedResult' => 'https://www.jofogas.hu/magyarorszag?q=ps4',
                'expectedException' => null,
            ],

            'single search term with page number' => [
                'filter' => 'ps4',
                'pageNumber' => 2,
                'expectedResult' => 'https://www.jofogas.hu/magyarorszag?q=ps4&o=2',
                'expectedException' => null,
            ],

            'multiple search term without page number' => [
                'filter' => 'ps4 dying',
                'pageNumber' => 0,
                'expectedResult' => 'https://www.jofogas.hu/magyarorszag?q=ps4%20dying',
                'expectedException' => null,
            ],

            'multiple search term with page number' => [
                'filter' => 'ps4 dying',
                'pageNumber' => 2,
                'expectedResult' => 'https://www.jofogas.hu/magyarorszag?q=ps4%20dying&o=2',
                'expectedException' => null,
            ],
        ];
    }


    private function createParsedSiteConfig(): ParsedSiteConfig
    {
        $config = new ParsedSiteConfig();

        $config->siteUrl = 'https://www.jofogas.hu/magyarorszag';
        $config->name = 'Jófogás';

        return $config;
    }
}
