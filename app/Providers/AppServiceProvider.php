<?php

namespace App\Providers;

use App\Models\Parser\Models\Jofogas\JofogasParseConfiguration;
use App\Models\Parser\Models\ParseConfigurationContainer;
use App\Models\Parser\Services\Jofogas\JofogasHtmlScraper;
use App\Models\Parser\Services\Jofogas\JofogasParser;
use App\Models\Parser\Services\Jofogas\JofogasUrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ParseConfigurationContainer::class, function() {
            return new ParseConfigurationContainer(
                [new JofogasParseConfiguration()]
            );
        });

        $this->app->bind(JofogasParser::class, function() {
            return new JofogasParser();
        });

        $this->app->bind(JofogasHtmlScraper::class, function() {
            return new JofogasHtmlScraper(
                resolve(JofogasUrlGenerator::class)
            );
        });

        $this->app->bind(JofogasUrlGenerator::class, function() {
            return new JofogasUrlGenerator();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
