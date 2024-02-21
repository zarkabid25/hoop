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

            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>

                        <p>Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <span class="small-box-footer" style="padding: 12px"></span>
                    {{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header text-center">
                <h6>My Orders</h6>
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
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 1; @endphp

{{--                    @if(auth()->user()->role !== 'developer')--}}
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ ucwords($order->design_name) }}</td>
                                <td>{{ ucwords($order->order_type) }}</td>
                                <td>{{ ucwords($order->customer->name) }}</td>
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
{{--                    @else--}}
{{--                        @forelse($orders as $order)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $count++ }}</td>--}}
{{--                                <td>{{ ucwords($order->order->design_name) }}</td>--}}
{{--                                <td>{{ $order->order->urgent }}</td>--}}
{{--                                <td>{{ $order->order->price }}</td>--}}
{{--                                <td>{{ (strlen($order->order->special_instruct) <= 20) ? $order->order->special_instruct : $order->order->special_instruct."..."}}</td>--}}
{{--                                <td>--}}
{{--                                    <div>--}}
{{--                                        <div style="display: inline-block">--}}
{{--                                            <a href="{{ route('order.show', ['order' => $order->order->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>--}}
{{--                                        </div>--}}

{{--                                        @if(auth()->user()->role == 'customer')--}}
{{--                                            <div style="display: inline-block">--}}
{{--                                                --}}{{--                                        <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>--}}
{{--                                                <a href="{{ route('order.edit', ['order' => $order->order->id]) }}" class="btn btn-info">Edit</a>--}}
{{--                                            </div>--}}

{{--                                            <div style="display: inline-block">--}}
{{--                                                <form action="{{ route('order.destroy', ['order' => $order->order->id]) }}" method="post" class="delete_form">--}}
{{--                                                    @method('delete')--}}
{{--                                                    @csrf--}}

{{--                                                    <button type="button" class="btn btn-danger delete_btn">Delete</button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}
{{--                    @endif--}}
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        {{--        <div class="row">--}}
        {{--            <!-- Left col -->--}}
        {{--            <section class="col-lg-7 connectedSortable">--}}
        {{--                <div class="col-5" style="margin-bottom: 20px">--}}
        {{--                    <label for="graph_type">Graphs List</label>--}}
        {{--                    <select id="graph_type" class="form-control">--}}
        {{--                        <option selected disabled>Select Graph</option>--}}
        {{--                        <option value="order_stats">Order Stats</option>--}}
        {{--                        <option value="order_type_stats">Order-type Stats</option>--}}
        {{--                        <option value="sale_per_month">Sale Per Month</option>--}}
        {{--                    </select>--}}
        {{--                </div>--}}
        {{--                <!-- Custom tabs (Charts with tabs)-->--}}
        {{--                <div class="card" id="order_stats" style="display: none">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <h3 class="card-title">--}}
        {{--                            <i class="fas fa-chart-pie mr-1"></i>--}}
        {{--                            Order Stats--}}
        {{--                        </h3>--}}
        {{--                        <div class="card-tools">--}}
        {{--                            <ul class="nav nav-pills ml-auto">--}}
        {{--                                <li class="nav-item">--}}
        {{--                                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Daily</a>--}}
        {{--                                </li>--}}
        {{--                                <li class="nav-item">--}}
        {{--                                    <a class="nav-link" href="#revenue-chart" data-toggle="tab">Monthly</a>--}}
        {{--                                </li>--}}
        {{--                            </ul>--}}
        {{--                        </div>--}}
        {{--                    </div><!-- /.card-header -->--}}
        {{--                    <div class="card-body">--}}
        {{--                        <div class="tab-content p-0">--}}
        {{--                            <!-- Morris chart - Sales -->--}}
        {{--                            <div class="chart tab-pane active" id="revenue-chart"--}}
        {{--                                 style="position: relative; height: 300px;">--}}
        {{--                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
        {{--                            </div>--}}
        {{--                            <div class="chart tab-pane" id="sales-chart"--}}
        {{--                                 style="position: relative; height: 300px;">--}}
        {{--                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div><!-- /.card-body -->--}}
        {{--                </div>--}}
        {{--                <!-- /.card -->--}}


        {{--                <!-- TO DO List -->--}}
        {{--                <div class="card" id="order_type_stats" style="display: none">--}}
        {{--                    <div class="card-header">--}}
        {{--                        <h3 class="card-title">--}}
        {{--                            <i class="fas fa-chart-bar mr-1"></i>--}}
        {{--                            Order-Type Stats--}}
        {{--                        </h3>--}}
        {{--                    </div><!-- /.card-header -->--}}
        {{--                    <div class="card-body">--}}
        {{--                        <canvas id="myBarChart"></canvas>--}}

        {{--                    </div><!-- /.card-body -->--}}
        {{--                </div>--}}
        {{--                <!-- /.card -->--}}
        {{--            </section>--}}
        {{--            <!-- /.Left col -->--}}
        {{--            <!-- right col (We are only adding the ID to make the widgets sortable)-->--}}
        {{--            <section class="col-lg-5 connectedSortable">--}}
        {{--                <!-- Map card -->--}}
        {{--                <div>--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-lg-12 col-6">--}}
        {{--                            <!-- small box -->--}}
        {{--                            <div class="small-box bg-primary">--}}
        {{--                                <div class="inner">--}}
        {{--                                    <h3>0</h3>--}}

        {{--                                    <p>Total Revisions</p>--}}
        {{--                                </div>--}}
        {{--                                <div class="icon">--}}
        {{--                                    <i class="ion ion-bag"></i>--}}
        {{--                                </div>--}}
        {{--                                <span class="small-box-footer">This Month</span>--}}
        {{--                                --}}{{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- ./col -->--}}
        {{--                        <div class="col-lg-12 col-6">--}}
        {{--                            <!-- small box -->--}}
        {{--                            <div class="small-box" style="background: #303641; color: white">--}}
        {{--                                <div class="inner">--}}
        {{--                                    <h3>0</h3>--}}

        {{--                                    <p>Total Conversion</p>--}}
        {{--                                </div>--}}
        {{--                                <div class="icon">--}}
        {{--                                    <i class="ion ion-stats-bars"></i>--}}
        {{--                                </div>--}}
        {{--                                <span class="small-box-footer">This Month</span>--}}
        {{--                                --}}{{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- ./col -->--}}
        {{--                    </div>--}}
        {{--                    <!-- /.card-body-->--}}
        {{--                    <div class="card-footer bg-transparent" style="display: none">--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-4 text-center">--}}
        {{--                                <div id="sparkline-1"></div>--}}
        {{--                                <div class="text-white">Visitors</div>--}}
        {{--                            </div>--}}
        {{--                            <!-- ./col -->--}}
        {{--                            <div class="col-4 text-center">--}}
        {{--                                <div id="sparkline-2"></div>--}}
        {{--                                <div class="text-white">Online</div>--}}
        {{--                            </div>--}}
        {{--                            <!-- ./col -->--}}
        {{--                            <div class="col-4 text-center">--}}
        {{--                                <div id="sparkline-3"></div>--}}
        {{--                                <div class="text-white">Sales</div>--}}
        {{--                            </div>--}}
        {{--                            <!-- ./col -->--}}
        {{--                        </div>--}}
        {{--                        <!-- /.row -->--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <!-- /.card -->--}}

        {{--                <!-- solid sales graph -->--}}
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
        {{--                <!-- /.card -->--}}

        {{--            </section>--}}
        {{--            <!-- right col -->--}}
        {{--        </div>--}}
        <!-- /.row (main row) -->
    </div>
@endsection

@section('JS')
    <script>
        new DataTable('#example')
    </script>
@endsection
