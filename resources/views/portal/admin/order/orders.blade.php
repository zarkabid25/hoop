@extends('portal.layout')
@section('title', 'All Order')

@section('content')
    <div class="container">

        @if(auth()->user()->role == 'customer' || auth()->user()->role == 'admin')
            <div class="text-right mb-3">
                <a href="{{ route('order.create') }}" class="btn btn-outline-danger">+ Create Order</a>
            </div>
        @endif

        @include('portal.filter.order-filter')

            <div class="card mt-3">
                <div class="card-header text-center">
                    @if(auth()->user()->role == 'admin') <h6>Orders</h6> @else <h6>My Orders</h6> @endif
                </div>
                <div class="card-body" id="orders">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>Order ID</th>
                            <th>Design Name</th>
                            <th>Design Type</th>
                            @if(auth()->user()->role == 'customer')
                                <th>CRO</th>
                            @else
                                <th>Customer Name</th>
                            @endif
                            @if(auth()->user()->role == 'admin')
                                <th>Referred</th>
                            @endif
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp

                        @if(auth()->user()->role !== 'developer')
                            @forelse($orders as $order)
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'customer')
                                    @php
                                        if(!empty($order->customer->referred)){
                                            $referred = \App\Models\User::where('email', $order->customer->referred)->first('name');
                                        }
                                        else{
                                            $referred = '';
                                        }
                                    @endphp
                                @endif

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ ucwords($order->design_name) }}</td>
                                    <td>{{ ucwords($order->order_type) }}</td>
                                    @if(auth()->user()->role == 'customer')
                                        <td>{{ !empty($referred) ? ucwords($referred->name) : '--' }}</td>
                                    @else
                                        <td>{{ ucwords($order->customer->name) }}</td>
                                    @endif

                                    @if(auth()->user()->role == 'admin')
                                        <td>{{ !empty($referred) ? ucwords($referred->name) : '--' }}</td>
                                    @endif
                                    <td>
                                        @if($order->order_status == '0')
                                            Pending
                                        @elseif ($order->order_status == '1')
                                            Approved
                                        @else
                                            Cancelled
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
                        @else
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ ucwords($order->order->design_name) }}</td>
                                    <td>{{ ucwords($order->order->order_type) }}</td>
                                    <td>{{ ucwords($order->order->customer->name) }}</td>
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
                                                <a href="{{ route('order.show', ['order' => $order->order->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>
                                            </div>

                                            @if(auth()->user()->role == 'customer')
                                                <div style="display: inline-block">
                                                                                            <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>
                                                    <a href="{{ route('order.edit', ['order' => $order->order->id]) }}" class="btn btn-info">Edit</a>
                                                </div>

                                                <div style="display: inline-block">
                                                    <form action="{{ route('order.destroy', ['order' => $order->order->id]) }}" method="post" class="delete_form">
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
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

@endsection

@section('JS')
    <script>
        new DataTable('#example');

        $('.delete_btn').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.delete_form').submit();
                }
            });
        });

        $('#filter').on('click', function () {
            var orderType = $('#order_type').val();
            var orderStatus = $('#order_status').val();

            $.ajax({
                type: 'GET',
                url: '{{ route('filter_order') }}',
                data: {
                    order_type: orderType,
                    order_status: orderStatus,
                },
                success: function (response) {
                    if (response.success) {
                        console.log(response.data);
                        $('#orders').html(response.data)
                    } else {
                        console.error('Filter failed: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        });

        $('#reset').on('click', function (){
           location.reload();
        });
    </script>
@endsection
