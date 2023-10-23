<?php

declare(strict_types=1);

namespace App\Models\Config\Services;

use App\Models\Config\Models\ParsedConfig;

class ConfigParser
{
    public function __construct(
        private readonly ConfigMapper $configMapper,
        private readonly ConfigFileContentProvider $configFileContentProvider,
    )
    {
    }


    public function parseConfig(): ParsedConfig
    {
        $configFileContent = $this->configFileContentProvider->provideConfigFileContent();

        return $this->configMapper->map($configFileContent);
    }
}
