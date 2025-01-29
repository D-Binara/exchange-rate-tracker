<?php


namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\DB;

class ExchangeRateController extends Controller
{
    /**
     * Display the exchange rates.
     */
    public function index()
    {
        $latestRates = ExchangeRate::latest('fetched_at')->first();

        if ($latestRates) {
            $latestRates->buying_price = number_format($latestRates->buying_price, 2);
            $latestRates->selling_price = number_format($latestRates->selling_price, 2);
        }

        $dailyRates = ExchangeRate::select(
            DB::raw("DATE_FORMAT(fetched_at, '%Y/%m/%d') as fetched_at"),
            DB::raw("FORMAT(buying_price, 2) as buying_price"),
            DB::raw("FORMAT(selling_price, 2) as selling_price")
        )
            ->whereDate('fetched_at', '>=', now()->subDay())
            ->orderBy('fetched_at')
            ->get();

        $weeklyRates = ExchangeRate::select(
            DB::raw("DATE_FORMAT(fetched_at, '%Y/%m/%d') as fetched_at"),
            DB::raw("FORMAT(buying_price, 2) as buying_price"),
            DB::raw("FORMAT(selling_price, 2) as selling_price")
        )
            ->whereDate('fetched_at', '>=', now()->subWeek())
            ->orderBy('fetched_at')
            ->get();

        $monthlyRates = ExchangeRate::select(
            DB::raw("DATE_FORMAT(fetched_at, '%Y/%m/%d') as fetched_at"),
            DB::raw("FORMAT(buying_price, 2) as buying_price"),
            DB::raw("FORMAT(selling_price, 2) as selling_price")
        )
            ->whereDate('fetched_at', '>=', now()->subMonth())
            ->orderBy('fetched_at')
            ->get();

        return view('exchange', [
            'latestRates' => $latestRates,
            'dailyRates' => $dailyRates,
            'weeklyRates' => $weeklyRates,
            'monthlyRates' => $monthlyRates,
        ]);
    }

}
