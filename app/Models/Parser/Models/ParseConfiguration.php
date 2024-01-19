<?php

declare(strict_types=1);

namespace App\Models\Parser\Models;

use App\Models\Parser\Services\HtmlScraper;
use App\Models\Parser\Services\Parser;

interface ParseConfiguration
{
    public function getKey(): string;


    public function getParser(): Parser;


    public function getHtmlScraper(): HtmlScraper;
}
