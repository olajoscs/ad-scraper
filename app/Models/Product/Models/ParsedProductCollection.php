<?php

declare(strict_types=1);

namespace App\Models\Product\Models;

class ParsedProductCollection
{
    /**
     * @var ParsedProduct[]
     */
    private array $parsedProducts = [];

    private bool $hasNextPage;

    public function addFromCollection(ParsedProductCollection $parsedProductCollection)
    {
        $this->parsedProducts = array_merge(
            $this->parsedProducts,
            $parsedProductCollection->getParsedProducts()
        );
    }


    /**
     * @return ParsedProduct[]
     */
    public function getParsedProducts(): array
    {
        return $this->parsedProducts;
    }


    public function hasNextPage(): bool
    {
        return $this->hasNextPage;
    }


    public function setHasNextPage(bool $hasNextPage): void
    {
        $this->hasNextPage = $hasNextPage;
    }
}
