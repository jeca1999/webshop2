// public/js/seller-analytics.js
// Chart.js bar chart for product sales analytics

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('productSalesChart');
    if (!ctx) return;
    const labels = window.productSalesLabels || [];
    const data = window.productSalesData || [];
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Units Sold',
                data: data,
                backgroundColor: 'rgba(37, 99, 235, 0.7)',
                borderColor: 'rgba(37, 99, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Product Sales (Units Sold)' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
