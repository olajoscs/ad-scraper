<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Config\Services\ConfigParser;

class AdParser
{
    public function __construct(
        private readonly ConfigParser $configParser,
        private readonly \App\Models\Parser\AdParser $adParser,
    )
    {
    }


    public function run(): void
    {
        $config = $this->configParser->parseConfig();

        $this->adParser->parse($config);
        $this->sendNotification();
    }


    private function sendNotification(): void
    {

    }
}
