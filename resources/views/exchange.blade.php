<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Rates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row d-flex align-items-stretch">
        <!-- Left Section -->
        <div class="col-md-5 col-sm-12 d-flex flex-column justify-content-between">
            <h4 class="card-title">Exchange Rates</h4>
            <h6 class="text-muted">USD/LKR</h6>
            <div class="row g-3 flex-grow-1">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card h-100 p-1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">Buying Rate</h5>
                            <h3 class="fw-bold mb-3">{{ $latestRates->buying_price ?? '0.0' }}</h3>
                            <p class="card-text text-muted mt-8">
                                The average rates currencies quoted on that day at 9.30 a.m. by commercial banks in
                                Colombo for Telegraph Transfers (TT). Lower buying rate means weaker rupee.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card h-100 p-1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">Indicative Rate</h5>
                            <h3 class="fw-bold mb-3">331.02</h3>
                            <p class="card-text text-muted mt-8">
                                Indicative rate of the USD/LKR Spot Exchange Rate is the weighted average rate of all
                                actual USD/LKR Spot transactions executed in the domestic inter-bank fx market.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card h-100  p-1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title  mb-3">Selling Rate</h5>
                            <h3 class="fw-bold mb-3">{{ $latestRates->selling_price ?? '0.0' }}</h3>
                            <p class="card-text text- text-muted mt-8">
                                The average rates currencies quoted on that day at 9.30 a.m. by commercial banks in
                                Colombo for Telegraph Transfers (TT). . Higher selling rate means weaker rupee.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section (Chart) -->
        <div class="col-md-7 col-sm-12 d-flex">
            <div class="card w-100 h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">USD/LKR Indicative Rates</h5>
                    <div class="d-flex justify-content-end mb-3">
                        <button id="dailyButton" class="btn btn-outline-secondary btn-sm filter-button"
                                onclick="loadChart('daily')">Day
                        </button>
                        <button id="weeklyButton" class="btn btn-outline-secondary btn-sm mx-2 filter-button"
                                onclick="loadChart('weekly')">Week
                        </button>
                        <button id="monthlyButton" class="btn btn-primary btn-sm filter-button"
                                onclick="loadChart('monthly')">Month
                        </button>
                    </div>
                    <div class="chart-container flex-grow-1">
                        <canvas id="exchangeRateChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dailyData" style="display: none;">@json($dailyRates)</div>
<div id="weeklyData" style="display: none;">@json($weeklyRates)</div>
<div id="monthlyData" style="display: none;">@json($monthlyRates)</div>

<script src="{{ asset('js/exchangeRates.js') }}"></script>
</body>
</html>
