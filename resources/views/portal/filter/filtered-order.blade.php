<table id="example" class="table table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Sr.#</th>
        <th>Order ID</th>
        <th>Design Name</th>
        <th>Design Type</th>
        @if(auth()->user()->role == 'customer' && $requestType != 'quote')
            <th>CRO</th>
        @else
            @if($requestType != 'quote')
                <th>Customer Name</th>
            @endif
        @endif

        @if(auth()->user()->role == 'admin')
            <th>Referred</th>
        @endif

        @if($requestType != 'quote')
            <th>Order Status</th>
        @endif
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
                @if(auth()->user()->role == 'customer' && $requestType != 'quote')
                    <td>{{ !empty($referred) ? ucwords($referred->name) : '--' }}</td>
                @else
                    @if($requestType != 'quote')
                        <td>{{ ucwords($order->customer->name) }}</td>
                    @endif
                @endif

                @if(auth()->user()->role == 'admin')
                    <td>{{ !empty($referred) ? ucwords($referred->name) : '--' }}</td>
                @endif

                @if($requestType != 'quote')
                    <td>
                        @if($order->order_status == '0')
                            Pending
                        @elseif ($order->order_status == '1')
                            Approved
                        @else
                            Cancelled
                        @endif
                    </td>
                @endif
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
