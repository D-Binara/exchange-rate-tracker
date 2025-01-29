<?php

namespace Tests\Feature;

use App\Services\ExchangeRateService;
use Goutte\Client;
use Mockery;
use Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    /**
     * Test fetching USD to LKR exchange rate from the website.
     */
    public function testFetchUSDToLKR()
    {
        // Mock the Goutte Client
        $mockClient = Mockery::mock(Client::class);
        $mockCrawler = Mockery::mock(\Symfony\Component\DomCrawler\Crawler::class);

        // Mock the request and filter process
        $mockClient->shouldReceive('request')
            ->once()
            ->with('GET', 'https://www.peoplesbank.lk/exchange-rates/')
            ->andReturn($mockCrawler);

        $mockCrawler->shouldReceive('filter')
            ->once()
            ->with('table tbody tr:contains("USD") td:nth-child(2)')
            ->andReturnSelf();

        $mockCrawler->shouldReceive('text')
            ->once()
            ->andReturn('300.50'); // Mocked rate

        // Inject the mocked client into the service
        $service = new ExchangeRateService();
        $serviceReflection = new \ReflectionClass($service);
        $clientProperty = $serviceReflection->getProperty('client');
        $clientProperty->setAccessible(true);
        $clientProperty->setValue($service, $mockClient);

        // Execute the method and assert the result
        $rate = $service->fetchUSDToLKR();

        $this->assertEquals(300.50, $rate, 'The exchange rate should match the mocked value.');
    }
}

