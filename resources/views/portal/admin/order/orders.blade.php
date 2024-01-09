@extends('portal.layout')
@section('title', 'All Order')

@section('content')
    <div class="container">

        @if(auth()->user()->role == 'customer' || auth()->user()->role == 'admin')
            <div class="text-right mb-3">
                <a href="{{ route('order.create') }}" class="btn btn-outline-danger">+ Create Order</a>
            </div>
        @endif

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Sr.#</th>
                <th>Design Name</th>
                <th>Urgent</th>
                <th>Price</th>
                <th>Special Instruction</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp

                @if(auth()->user()->role !== 'developer')
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ ucwords($order->design_name) }}</td>
                            <td>{{ $order->urgent }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ (strlen($order->special_instruct) <= 20) ? $order->special_instruct : $order->special_instruct."..."}}</td>
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
                            <td>{{ ucwords($order->order->design_name) }}</td>
                            <td>{{ $order->order->urgent }}</td>
                            <td>{{ $order->order->price }}</td>
                            <td>{{ (strlen($order->order->special_instruct) <= 20) ? $order->order->special_instruct : $order->order->special_instruct."..."}}</td>
                            <td>
                                <div>
                                    <div style="display: inline-block">
                                        <a href="{{ route('order.show', ['order' => $order->order->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>
                                    </div>

                                    @if(auth()->user()->role == 'customer')
                                        <div style="display: inline-block">
                                            {{--                                        <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>--}}
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
    </script>
@endsection
