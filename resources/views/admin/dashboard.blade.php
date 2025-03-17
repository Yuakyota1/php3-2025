@extends('admin.layout')

@section('content')
    <h2>📊 Thống kê doanh thu</h2>
    <canvas id="revenueChart"></canvas>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('admin.revenue.data') }}")
        .then(response => response.json())
        .then(data => {
            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: 'Doanh thu',
                            data: data.revenue,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Số lượng sản phẩm',
                            data: data.quantity,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
});

</script>
@endsection