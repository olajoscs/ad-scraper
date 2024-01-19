<?php

declare(strict_types=1);

namespace App\Models\Parser\Services\Jofogas;

use App\Models\Config\Models\ParsedSiteConfig;
use App\Models\Parser\Services\Parser;
use App\Models\Product\Models\ParsedProductCollection;

class JofogasParser implements Parser
{
    public function __construct()
    {
    }


    public function parse(string $html, ParsedSiteConfig $parsedSiteConfig): ParsedProductCollection
    {
    }
}
