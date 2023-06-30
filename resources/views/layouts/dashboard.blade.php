@include('includes/sidebar')
<section class="section">
    <h1 class="section-header">
        <div>Dashboard</div>
    </h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                    <i class="ion ion-person"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Users</h4>
                    </div>
                    <div class="card-body">
                        {{$user->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-sm-3">
                <div class="card-icon bg-danger">
                    <i class="ion ion-ios-paper-outline"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body">
                        {{ $product->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-sm-3">
                <div class="card-icon bg-warning">
                    <i class="ion ion-paper-airplane"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Sells</h4>
                    </div>
                    <div class="card-body">
                        {{ number_format($sell,2) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card card-sm-3">
                <div class="card-icon bg-success">
                    <i class="ion ion-record"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Stock</h4>
                    </div>
                    <div class="card-body">
                        {{ number_format($capital,2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="#" class="btn">Month</a>
                        </div>
                    </div>
                    <h4>Statistics</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="100"></canvas>
                    <div class="statistic-details mt-sm-3">
                        <div class="statistic-details-item">
                            <small class="text-muted"><span class="text-primary"><i class="ion-arrow-up-b"></i></span>
                                7%</small>
                            <div class="detail-value">{{ number_format($todaysales,2) }}</div>
                            <div class="detail-name">Today's Sales</div>
                        </div>
                        <div class="statistic-details-item">
                            <small class="text-muted"><span class="text-danger"><i class="ion-arrow-down-b"></i></span>
                                23%</small>
                            <div class="detail-value">{{ number_format($faida,2)}}</div>
                            <div class="detail-name">Today's Profit</div>
                        </div>
                        <div class="statistic-details-item">
                            <small class="text-muted"><span class="text-primary"><i
                                        class="ion-arrow-up-b"></i></span>9%</small>
                            <div class="detail-value">{{ number_format($pprofit,2) }}</div>
                            <div class="detail-name">Total Profit</div>
                        </div>
                        <div class="statistic-details-item">
                            <small class="text-muted"><span class="text-primary"><i class="ion-arrow-up-b"></i></span>
                                19%</small>
                            <div class="detail-value">{{ number_format($madeni)}}</div>
                            <div class="detail-name">Debts</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-3 col-sm-3">
            <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                    <i class="ion ion-soup-can"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Cash Amount</h4>
                    </div>
                    <div class="card-body">
                        {{number_format($cash,2)}}
                    </div>
                </div>
            </div>
            <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                    <i class="ion ion-soup-can"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Cash Amount</h4>
                    </div>
                    <div class="card-body">
                        {{number_format($cash,2)}}
                    </div>
                </div>
            </div>
            <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                    <i class="ion ion-soup-can"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Cash Amount</h4>
                    </div>
                    <div class="card-body">
                        {{number_format($cash,2)}}
                    </div>
                </div>
            </div>
            <div class="card card-sm-3">
                <div class="card-icon bg-primary">
                    <i class="ion ion-soup-can"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Cash Amount</h4>
                    </div>
                    <div class="card-body">
                        {{number_format($cash,2)}}
                    </div>
                </div>
            </div>

        </div>

    </div>


</section>
<script src="../dist/modules/chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels)?>,
       
        datasets: [{
          label: 'Sales',
          data: <?php echo json_encode($amounts)?>,
          borderWidth: 2,
          backgroundColor: 'rgba(220, 53, 69, 1)',
          borderColor: 'rgba(220, 53, 69, 1)',
          borderWidth: 2.5,
          pointBackgroundColor: '#ffffff',
          pointRadius: 4
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    // stepSize: 150
                }
            }],
            xAxes: [{
                gridLines: {
                    display: true
                }
            }]
        },
    }
});
</script>

@include('includes/footer')
