@extends('portal.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $monthOrders }}</h3>

                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <span class="small-box-footer">This Month</span>
                    {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $monthQuotes }}</h3>

                        <p>Total Quotes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <span class="small-box-footer">This Month</span>
                    {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-warning" style="color: white !important;">
                    <div class="inner">
                        <h3>{{ $allOrders }}</h3>

                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <span class="small-box-footer">Lifetime</span>
                    {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
{{--            <div class="col-lg-2 col-6">--}}
{{--                <!-- small box -->--}}
{{--                <div class="small-box bg-danger">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>0</h3>--}}

{{--                        <p>Total Paid</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-pie-graph"></i>--}}
{{--                    </div>--}}
{{--                    <span class="small-box-footer">Lifetime</span>--}}
{{--                    --}}{{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>0</h3>

                        <p style="font-size: 14px">Total Outstanding</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <span class="small-box-footer" style="padding: 13px"></span>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $cancelledOrders }}</h3>

                        <p>Cancelled Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <span class="small-box-footer">Monthly</span>
                    {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="card mt-3 mb-5">
            <div class="card-header text-center">
                <h6>Orders</h6>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sr.#</th>
                        <th>Order ID</th>
                        <th>Design Name</th>
                        <th>Design Type</th>
                        <th>Customer Name</th>
                        <th>Referred</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 1; @endphp

                    {{--                    @if(auth()->user()->role !== 'developer')--}}
                    @forelse($orders as $order)
                        @php
                            if(!empty($order->customer->referred)){
                                $referred = \App\Models\User::where('email', $order->customer->referred)->first('name');
                            }
                            else{
                                $referred = '';
                            }
                        @endphp
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ ucwords($order->design_name) }}</td>
                            <td>{{ ucwords($order->order_type) }}</td>
                            <td>{{ ucwords($order->customer->name) }}</td>
                            <td>{{ !empty($referred) ? ucwords($referred->name) : '--' }}</td>
                            <td>
                                @if($order->order_status == '0')
                                    <span class="badge badge-info">Pending</span>
                                @elseif ($order->order_status == '1')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div style="display: inline-block">
                                        <a href="{{ route('order.show', ['order' => $order->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>
                                    </div>

                                    @if(auth()->user()->role == 'customer')
                                        <div style="display: inline-block">
                                            {{--                                        <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>--}}
                                            <a href="{{ route('order.edit', ['order' => $order->id]) }}" class="btn btn-info">Edit</a>
                                        </div>

                                        <div style="display: inline-block">
                                            <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post" class="delete_form">
                                                @method('delete')
                                                @csrf

                                                <button type="button" class="btn btn-danger delete_btn">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Map card -->
                <div>
                    <div class="row">
                        <div class="col-lg-12 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Total Revisions</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <span class="small-box-footer">This Month</span>
                                {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-12 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background: #303641; color: white">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Total Conversion</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <span class="small-box-footer">This Month</span>
                                {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent" style="display: none">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                {{--                                <div class="text-white">Visitors</div>--}}
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                {{--                                <div class="text-white">Online</div>--}}
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                {{--                                <div class="text-white">Sales</div>--}}
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- solid sales graph -->
                {{--                <div class="card bg-gradient-info" id="total_month_sale" style="display: none">--}}
                {{--                    <div class="card-header border-0">--}}
                {{--                        <h3 class="card-title">--}}
                {{--                            <i class="fas fa-th mr-1"></i>--}}
                {{--                            Total Sale Per Month--}}
                {{--                        </h3>--}}

                {{--                        <div class="card-tools">--}}
                {{--                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">--}}
                {{--                                <i class="fas fa-minus"></i>--}}
                {{--                            </button>--}}
                {{--                            <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">--}}
                {{--                                <i class="fas fa-times"></i>--}}
                {{--                            </button>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="card-body">--}}
                {{--                        <canvas class="chart" id="line-chart"--}}
                {{--                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                {{--                    </div>--}}
                {{--                    <!-- /.card-body -->--}}
                {{--                    <div class="card-footer bg-transparent" style="display: none">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-4 text-center">--}}
                {{--                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60"--}}
                {{--                                       data-height="60"--}}
                {{--                                       data-fgColor="#39CCCC">--}}

                {{--                                <div class="text-white">Mail-Orders</div>--}}
                {{--                            </div>--}}
                {{--                            <!-- ./col -->--}}
                {{--                            <div class="col-4 text-center">--}}
                {{--                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60"--}}
                {{--                                       data-height="60"--}}
                {{--                                       data-fgColor="#39CCCC">--}}

                {{--                                <div class="text-white">Online</div>--}}
                {{--                            </div>--}}
                {{--                            <!-- ./col -->--}}
                {{--                            <div class="col-4 text-center">--}}
                {{--                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60"--}}
                {{--                                       data-height="60"--}}
                {{--                                       data-fgColor="#39CCCC">--}}

                {{--                                <div class="text-white">In-Store</div>--}}
                {{--                            </div>--}}
                {{--                            <!-- ./col -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.row -->--}}
                {{--                    </div>--}}
                {{--                    <!-- /.card-footer -->--}}
                {{--                </div>--}}
                <!-- /.card -->

            </section>
            <!-- /.Left col -->


            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-7 connectedSortable">
                <div class="col-5" style="margin-bottom: 20px">
                    <label for="graph_type">Graphs List</label>
                    <select id="graph_type" class="form-control">
                        <option selected disabled>Select Graph</option>
                        <option value="order_stats">Order Stats</option>
                        <option value="order_type_stats">Order-type Stats</option>
                        {{--                        <option value="sale_per_month">Sale Per Month</option>--}}
                    </select>
                </div>
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card" id="order_stats" style="display: none">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Order Stats
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#revenue-chart" data-toggle="tab">Monthly</a>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <span class="px-2" style="background-color: lightgrey;"></span> Indicates Quotes <br>
                                <span class="px-2" style="background-color: deepskyblue;"></span> Indicates Orders
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart"
                                 style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart"
                                 style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- TO DO List -->
                <div class="card" id="order_type_stats" style="display: none">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Order-Type Stats
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <canvas id="myBarChart"></canvas>

                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div>
@endsection
@section('JS')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new DataTable('#example')

        $('#graph_type').on('change', function (){
            var order_stats = $(this).val();
            if(order_stats == 'order_stats'){
                $('#order_stats').show();
            }
            else{
                $('#order_stats').hide();
            }

            if(order_stats == 'sale_per_month'){
                $('#total_month_sale').show();
            }
            else{
                $('#total_month_sale').hide();
            }

            if(order_stats == 'order_type_stats'){
                $('#order_type_stats').show();
            }
            else{
                $('#order_type_stats').hide();
            }
        });

        $(document).ready(function (){
            $.ajax({
                url: '{{ url('/order-chart-data') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    updateBarChart(data);
                    $('#order_type_stats').show();
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });

            function updateBarChart(data) {
                var ctx = document.getElementById('myBarChart').getContext('2d');

                var options = {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 20,
                            boxWidth: 10
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                };

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: data.datasets,
                    },
                    options: options
                });

                // Display count on each bar
                var datasets = myBarChart.data.datasets;

                datasets.forEach(function (dataset, i) {
                    var bars = myBarChart.getDatasetMeta(i).data;

                    bars.forEach(function (bar, j) {
                        var x = bar.x;
                        var y = bar.y;
                        var label = dataset.label + ': ' + dataset.data[j];
                        ctx.fillStyle = 'black'; // Set the font color
                        ctx.fillText(label, x, y - 5);
                    });
                });
            }

            // Sales chart start
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')

            var salesChartData = {
                labels: [],
                datasets: [
                    {
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: []
                    },
                    {
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: []
                    }
                ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20,
                            max: 200
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            });

            function updateChartData(type) {
                $.ajax({
                    url: '{{ url('/getChartData') }}',
                    type: 'GET',
                    data: { type: type },
                    success: function (data) {
                        salesChart.data.labels = data.labels;
                        salesChart.data.datasets[0].data = data.orders;
                        salesChart.data.datasets[1].data = data.quotes;
                        salesChart.update();
                    },
                    error: function (error) {
                        console.error('Error fetching chart data:', error);
                    }
                });
            }

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var tabType = $(e.target).text().toLowerCase();
                updateChartData(tabType);
            });

            updateChartData('daily');

            // $('#order_type_stats').hide();
        });

        // Sales chart end



    </script>
@endsection
