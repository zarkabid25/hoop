@extends('portal.layout')
@section('title', 'All Quotes')

@section('content')
    <div class="container">

        <div class="text-right mb-3">
            <a href="{{ route('quote.create') }}" class="btn btn-outline-danger">+ Create Quote</a>
        </div>

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

                @forelse($quotes as $quote)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ ucwords($quote->design_name) }}</td>
                        <td>{{ $quote->urgent }}</td>
                        <td>{{ $quote->price }}</td>
                        <td>{{ (strlen($quote->special_instruct) <= 20) ? $quote->special_instruct : $quote->special_instruct."..."}}</td>
                        <td>
                            <div>
                                <div style="display: inline-block">
                                    <a href="{{ route('quote.show', ['quote' => $quote->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Details</a>
                                </div>

                                <div style="display: inline-block">
                                    {{--                                        <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $order->id }});">Edit</a>--}}
                                    <a href="{{ route('quote.edit', ['quote' => $quote->id]) }}" class="btn btn-info">Edit</a>
                                </div>

                                <div style="display: inline-block">
                                    <form action="{{ route('quote.destroy', ['quote' => $quote->id]) }}" method="post" class="delete_form">
                                        @method('delete')
                                        @csrf

                                        <button type="button" class="btn btn-danger delete_btn">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
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