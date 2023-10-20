<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Config\Services\ConfigParser;

class AdParser
{
    public function __construct(private readonly ConfigParser $configParser)
    {
    }


    public function run(): void
    {
        $config = $this->configParser->parseConfig();

        dd($config);
    }
}
