@extends('portal.layout')
@section('title', 'All Quotes')

@section('css')
    <style>
        .form-control{
            font-size: 0.8rem;
        }

        label{
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="container mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date">Invoice Start Date:</label>
                            <input type="date" id="start_date" class="form-control" />
                        </div>

                        <div class="col-md-6">
                            <label for="end_date">Invoice End Date:</label>
                            <input type="date" id="end_date" class="form-control" />
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn" id="filter_btn" style="color: white; background-color: #17a2b8">Filter</button>
                        <button type="button" class="btn btn-danger" id="reset_btn">Reset</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6>Manually Generate Invoice</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('manual-invoice-download') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="invoice_start_date">Invoice Start Date:</label>
                                <input type="date" name="invoice_start_date" class="form-control" />
                            </div>

                            <div class="col-md-4">
                                <label for="invoice_end_date">Invoice End Date:</label>
                                <input type="date" name="invoice_end_date" class="form-control" />
                            </div>

                            <div class="col-md-4" style="padding-top: 30px">
                                <button type="submit" class="btn" id="generate_invoice" style="color: white; background-color: #17a2b8">Generate Invoice</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="table_section">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Invoice Customer</th>
                    <th>Invoice Created Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $count = 1; @endphp
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ ucwords($invoice->customer->name) }}</td>
                        <td>{{ date('Y-m-d', strtotime($invoice->created_at)) }}</td>
                        <td>
                            <a href="{{ route('invoice-download', ['id' => $invoice->id]) }}" class="btn" style="color: white; background-color: #17a2b8">Download</a>
                        </td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('JS')
    <script>
        new DataTable('#example');

        $('#filter_btn').on('click', function (){
           let start = $('#start_date').val();
           let end = $('#end_date').val();

           $.ajax({
              url: '{{ route('filter-invoices') }}',
              type: 'GET',
              dataType: 'JSON',
              data: {start:start, end:end},
               success: function (response){
                  $('#table_section').html(response.data);
               }
           });
        });

        {{--$('#generate_invoice').on('click', function (){--}}
        {{--    let start = $('#invoice_start_date').val();--}}
        {{--    let end = $('#invoice_end_date').val();--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route('manual-invoice-download') }}',--}}
        {{--        type: 'GET',--}}
        {{--        dataType: 'JSON',--}}
        {{--        data: {start:start, end:end},--}}
        {{--        success: function (response){--}}
        {{--            $('#table_section').html(response.data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        $('#reset_btn').on('click', function (){
           location.reload();
        });
    </script>
@endsection
