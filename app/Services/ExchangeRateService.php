<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    public function fetchUSDToLKR()
    {
        try {

            $client = HttpClient::create();
            $response = $client->request('GET', 'https://www.peoplesbank.lk/exchange-rates/');
            $html = $response->getContent();

            $crawler = new Crawler($html);

            $usdRow = $crawler->filter('tr')->reduce(function (Crawler $node) {
                return str_contains($node->text(), 'US Dollars');
            });

            if ($usdRow->count() > 0) {
                $buyingRate = $usdRow->children()->eq(2)->text();
                $sellingRate = $usdRow->children()->eq(3)->text();

                return [
                    'buying_price' => floatval($buyingRate),
                    'selling_price' => floatval($sellingRate)
                ];
            }

            throw new \Exception('USD exchange rate not found.');
        } catch (\Exception $e) {
            Log::error('Error scraping exchange rate: ' . $e->getMessage());
            throw new \Exception('Failed to scrape exchange rate.');
        }
    }
}

