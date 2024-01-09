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
