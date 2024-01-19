<?php

declare(strict_types=1);

namespace App\Models\Parser\Models;

use App\Models\Parser\Exceptions\ParserNotFoundException;

class ParseConfigurationContainer
{
    /**
     * @var ParseConfiguration[]
     */
    private array $parseConfigurations;


    /**
     * @param ParseConfiguration[] $parseConfigurations
     */
    public function __construct(array $parseConfigurations = [])
    {
        $this->parseConfigurations = $parseConfigurations;
    }


    /**
     * @return ParseConfiguration[]
     */
    public function getParseConfigurations(): array
    {
        return $this->parseConfigurations;
    }


    public function getParserConfiguration(string $key): ParseConfiguration
    {
        foreach ($this->parseConfigurations as $parseConfiguration) {
            if ($parseConfiguration->getKey() === $key) {
                return $parseConfiguration;
            }
        }

        throw new ParserNotFoundException('Parser not found: ' . $key);
    }
}
