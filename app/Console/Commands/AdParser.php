<?php

namespace App\Console\Commands;

use App\Models\AdParser as AdParserService;
use Illuminate\Console\Command;

class AdParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse ads based on the config and send email notification about changed or new ads.';


    public function __construct(private readonly AdParserService $adParser)
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->adParser->run();
    }
}
