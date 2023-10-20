<?php

declare(strict_types=1);

namespace App\Models\Config\Services;

use App\Models\Config\Exceptions\MissingConfigFileException;
use App\Models\Config\Models\ParsedConfig;
use Symfony\Component\Yaml\Yaml;

class ConfigParser
{
    private const CONFIG_FILE = 'adparser.yml';


    public function __construct(
        private readonly Yaml         $yaml,
        private readonly ConfigMapper $configMapper
    )
    {
    }


    public function parseConfig(): ParsedConfig
    {
        $parsedConfig = $this->getParsedConfigFileContent();

        return $this->configMapper->map($parsedConfig);
    }


    private function getParsedConfigFileContent(): array
    {
        $path = config_path(self::CONFIG_FILE);

        if (!file_exists($path)) {
            throw new MissingConfigFileException(self::CONFIG_FILE . ' config file is missing. Create it by using the exapmle config file in the config folder');
        }

        return $this->yaml::parseFile($path);
    }
}
