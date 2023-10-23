<?php

declare(strict_types=1);

namespace App\Models\Config\Services;

use App\Models\Config\Exceptions\MissingConfigFileException;
use Symfony\Component\Yaml\Yaml;

class ConfigFileContentProvider
{
    private const CONFIG_FILE = 'adparser.yml';


    public function __construct(private readonly Yaml $yaml)
    {
    }


    public function provideConfigFileContent(): array
    {
        $path = config_path(self::CONFIG_FILE);

        if (!file_exists($path)) {
            throw new MissingConfigFileException(
                sprintf('%s config file is missing. Create it by using the exapmle config file in the config folder',
                    self::CONFIG_FILE
                )
            );
        }

        return $this->yaml::parseFile($path);
    }
}
