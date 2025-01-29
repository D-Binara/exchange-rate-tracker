function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toISOString().split('T')[0].replace(/-/g, '/');
}

function formatPrice(value) {
    return parseFloat(value).toFixed(2);
}

const dailyData = JSON.parse(document.getElementById('dailyData').textContent);
const weeklyData = JSON.parse(document.getElementById('weeklyData').textContent);
const monthlyData = JSON.parse(document.getElementById('monthlyData').textContent);

const datasets = {
    daily: {
        labels: dailyData.map(rate => formatDate(rate.fetched_at)),
        buyingPrices: dailyData.map(rate => formatPrice(rate.buying_price)),
        sellingPrices: dailyData.map(rate => formatPrice(rate.selling_price)),
    },
    weekly: {
        labels: weeklyData.map(rate => formatDate(rate.fetched_at)),
        buyingPrices: weeklyData.map(rate => formatPrice(rate.buying_price)),
        sellingPrices: weeklyData.map(rate => formatPrice(rate.selling_price)),
    },
    monthly: {
        labels: monthlyData.map(rate => formatDate(rate.fetched_at)),
        buyingPrices: monthlyData.map(rate => formatPrice(rate.buying_price)),
        sellingPrices: monthlyData.map(rate => formatPrice(rate.selling_price)),
    },
};

const ctx = document.getElementById('exchangeRateChart').getContext('2d');

const buyingGradient = ctx.createLinearGradient(0, 0, 0, 400);
buyingGradient.addColorStop(0, 'rgba(40, 167, 69, 0.4)');
buyingGradient.addColorStop(1, 'rgba(40, 167, 69, 0)');

const sellingGradient = ctx.createLinearGradient(0, 0, 0, 400);
sellingGradient.addColorStop(0, 'rgba(220, 53, 69, 0.4)');
sellingGradient.addColorStop(1, 'rgba(220, 53, 69, 0)');

let chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: datasets.daily.labels,
        datasets: [
            {
                label: 'Buying Price',
                data: datasets.daily.buyingPrices,
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 2,
                fill: true,
                backgroundColor: buyingGradient,
                pointRadius: 0,
                pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                pointHoverRadius: 6,
                tension: 0,
            },
            {
                label: 'Selling Price',
                data: datasets.daily.sellingPrices,
                borderColor: 'rgba(220, 53, 69, 1)',
                borderWidth: 2,
                fill: true,
                backgroundColor: sellingGradient,
                pointRadius: 0,
                pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                pointHoverRadius: 6,
                tension: 0,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#6C757D',
                    font: {
                        size: 14
                    }
                }
            },
            tooltip: {
                enabled: true,
                mode: 'index',
                intersect: false,
                backgroundColor: '#ffffff',
                borderColor: '#6C757D',
                borderWidth: 1,
                titleColor: '#000',
                bodyColor: '#000',
                bodyFont: {
                    weight: 'bold',
                },
                padding: 10,
                cornerRadius: 10,
                position: 'nearest',
                callbacks: {
                    title: function (tooltipItems) {
                        return `Date: ${tooltipItems[0].label}`;
                    },
                    label: function (tooltipItem) {
                        return ` ${tooltipItem.dataset.label}: LKR ${tooltipItem.raw}`;
                    }
                }
            }
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Time',
                    color: '#6C757D',
                },
                ticks: {
                    color: '#6C757D',
                }
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: 'Price (LKR)',
                    color: '#6C757D',
                },
                ticks: {
                    color: '#6C757D',
                },
                beginAtZero: false
            },
        },
        hover: {
            mode: 'index',
            intersect: false
        }
    },
});

function loadChart(period) {
    chart.data.labels = datasets[period].labels;
    chart.data.datasets[0].data = datasets[period].buyingPrices;
    chart.data.datasets[1].data = datasets[period].sellingPrices;
    chart.update();

    document.querySelectorAll('.filter-button').forEach(btn => {
        btn.classList.remove('btn-primary', 'btn-outline-secondary');
        btn.classList.add('btn-outline-green');
    });
    document.getElementById(`${period}Button`).classList.remove('btn-outline-green');
    document.getElementById(`${period}Button`).classList.add('btn-primary');
}
