<?php

declare(strict_types=1);

namespace App\Models\Parser\Models\Jofogas;

use App\Models\Parser\Models\ParseConfiguration;
use App\Models\Parser\Services\HtmlScraper;
use App\Models\Parser\Services\Jofogas\JofogasHtmlScraper;
use App\Models\Parser\Services\Jofogas\JofogasParser;
use App\Models\Parser\Services\Parser;

class JofogasParseConfiguration implements ParseConfiguration
{
    public function getKey(): string
    {
        return 'jofogas';
    }


    public function getParser(): Parser
    {
        return resolve(JofogasParser::class);
    }


    public function getHtmlScraper(): HtmlScraper
    {
        return resolve(JofogasHtmlScraper::class);
    }
}
