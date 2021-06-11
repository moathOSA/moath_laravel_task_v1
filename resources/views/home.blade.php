@extends('layouts.app')

@section('content')

    <div class="card-deck d-flex justify-content-between m-auto">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Users</div>
            <div class="card-body">
                <p class="card-text">{{$users}}</p>
            </div>
        </div>
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Products</div>
            <div class="card-body">
                <p class="card-text">{{$products}}</p>
            </div>
        </div>
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <p class="card-text">{{$categories}}</p>
            </div>
        </div>
    </div>

    <canvas id="myChart" ></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            <?php
            $date = [];
            $total = [];
                foreach ($reports as $data):
                    $date[] = $data->date;
                    $total[] = $data->total_products
                ?>
                <?php endforeach;?>
            labels: [<?php echo sprintf("'%s'", implode("','", $date ) );?>],
                datasets: [{
                    label: '# of products',
                    data: [<?php echo implode(',',$total);?>],
                         backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

