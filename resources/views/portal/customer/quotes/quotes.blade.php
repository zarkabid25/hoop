@extends('portal.layout')
@section('title', 'All Quotes')

@section('content')
    <div class="container">

        <div class="text-right mb-3">
            <a href="{{ route('quote.create') }}" class="btn btn-outline-danger">+ Create Quote</a>
        </div>

        @include('portal.filter.order-filter')

        <div class="card mt-3">
            <div class="card-header text-center">
                <h6>My Quotes</h6>
            </div>

            <div class="card-body" id="quotes">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sr.#</th>
                        <th>Design Name</th>
{{--                        <th>Urgent</th>--}}
                        <th>Price</th>
                        <th>Design Type</th>
{{--                        <th>Special Instruction</th>--}}
                        @if(auth()->user()->role == 'admin')
                            <th>Modified At</th>
                        @endif
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 1; @endphp

                    @forelse($quotes as $quote)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ ucwords($quote->design_name) }}</td>
{{--                            <td>{{ $quote->urgent }}</td>--}}
                            <td>{{ $quote->price }}</td>
                            <td>{{ ucwords($quote->order_type) }}</td>
{{--                            <td>{{ (strlen($quote->special_instruct) <= 20) ? $quote->special_instruct : $quote->special_instruct."..."}}</td>--}}
                            @if(auth()->user()->role == 'admin')
                                <td>{{ ($quote->updated_at != $quote->created_at) ? 'Yes' : '--' }}</td>
                            @endif
                            <td>
                                <div>
                                    <div style="display: inline-block">
                                        <a href="{{ route('quote.show', ['quote' => $quote->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>
                                    </div>

                                    <div style="display: inline-block">
                                        {{--                                        <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>--}}
                                        <a href="{{ route('quote.edit', ['quote' => $quote->id]) }}" class="btn btn-info">Edit</a>
                                    </div>

{{--                                    <div style="display: inline-block">--}}
{{--                                        <form action="{{ route('quote.destroy', ['quote' => $quote->id]) }}" method="post" class="delete_form">--}}
{{--                                            @method('delete')--}}
{{--                                            @csrf--}}

{{--                                            <button type="button" class="btn btn-danger delete_btn">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
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
            var requestType = 'quote';

            $.ajax({
                type: 'GET',
                url: '{{ route('filter_order') }}',
                data: {
                    order_type: orderType,
                    request_type: requestType
                },
                success: function (response) {
                    if (response.success) {
                        console.log(response.data);
                        $('#quotes').html(response.data)
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
