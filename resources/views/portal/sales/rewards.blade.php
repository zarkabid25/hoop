@extends('portal.layout')
@section('title', 'All Rewards')

@section('content')
    <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Sr.#</th>
                <th>Order ID</th>
                <th>Order Price</th>
                <th>Order Reward</th>
            </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp

            @forelse($orders as $order)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $order->order->id }}</td>
                    <td>{{ $order->order->price }}</td>
                    <td>{{  number_format((10 / 100) * $order->order->price, 2) }}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>

@endsection

@section('JS')
    <script>
        new DataTable('#example');
    </script>
@endsection
