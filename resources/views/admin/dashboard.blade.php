@extends('admin.layout')

@section('content')
<h2>📊 Thống kê doanh thu</h2>

<!-- Date Range Picker -->
<div style="margin-bottom: 20px;">
    <label for="start_date">Từ ngày:</label>
    <input type="date" id="start_date" value="{{ now()->subDays(30)->format('Y-m-d') }}">
    <label for="end_date">Đến ngày:</label>
    <input type="date" id="end_date" value="{{ now()->format('Y-m-d') }}">
    <button onclick="updateChart()">Cập nhật</button>
</div>

<canvas id="revenueChart"></canvas>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartInstance = null;

    function fetchRevenueData(startDate, endDate) {
        const url = new URL("{{ route('admin.revenue.data') }}");
        if (startDate) url.searchParams.append('start_date', startDate);
        if (endDate) url.searchParams.append('end_date', endDate);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (chartInstance) {
                    chartInstance.destroy();
                }

                chartInstance = new Chart(document.getElementById('revenueChart'), {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: 'Doanh thu',
                                data: data.revenue,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Doanh thu thực tế (sau chi phí)',
                                data: data.real_revenue,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                            },
                            {
                                label: 'Số lượng sản phẩm',
                                data: data.quantity,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Giá trị (VND)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Ngày'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += new Intl.NumberFormat('vi-VN', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }).format(context.parsed.y);
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching revenue data:', error));
    }

    function updateChart() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        fetchRevenueData(startDate, endDate);
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', function() {
        fetchRevenueData();
    });
</script>
@endsection