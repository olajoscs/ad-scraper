<?php

declare(strict_types=1);

namespace App\Models\Parser\Services\Jofogas;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Exceptions\MissingFilterUrlGeneratorException;
use App\Models\Parser\Services\UrlGenerator;

class JofogasUrlGenerator implements UrlGenerator
{
    public function generate(ParsedSiteConfig $parsedSiteConfig, string $filter, int $pageNumber): string
    {
        if (!$filter) {
            throw new MissingFilterUrlGeneratorException('Filter is missing when generating url for ' . $parsedSiteConfig->name);
        }

        $url = $parsedSiteConfig->siteUrl;

        $getParameters = $this->createGetParameters($filter, $pageNumber);

        return $url . '?' . http_build_query($getParameters, '', null, PHP_QUERY_RFC3986);
    }


    private function createGetParameters(string $filter, int $pageNumber): array
    {
        $getParameters = [
            'q' => $filter,
        ];

        if ($pageNumber) {
            $getParameters = array_merge($getParameters, [
                'o' => $pageNumber,
            ]);
        }

        return $getParameters;
    }
}
