<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ExchangeRateService;
use App\Models\ExchangeRate;

class FetchExchangeRate extends Command
{
    protected $signature = 'fetch:exchange-rate';
    protected $description = 'Fetch and store the USD to LKR exchange rate';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ExchangeRateService $service)
    {
        try {
            $rates = $service->fetchUSDToLKR();
            ExchangeRate::create([
                'buying_price' => $rates['buying_price'],
                'selling_price' => $rates['selling_price'],
                'fetched_at' => now(),
            ]);

            $this->info('Exchange rate saved successfully.');
        } catch (\Exception $e) {
            $this->error('Error fetching exchange rate: ' . $e->getMessage());
        }
    }
}

