@extends('portal.layout')
@section('title', 'Company Details')

@section('content')
    <div class="container">
        <div class="text-right mb-4">
            <a href="" class="btn btn-outline-danger">+ Add Details</a>
        </div>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Sr.#</th>
                <th>Field Title</th>
                <th>Field Value</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp

            @forelse($companyDetails as $companyDetail)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ ucwords($companyDetail->field_title) }}</td>
                    <td>{{ ucwords($companyDetail->field_value) }}</td>
                    <td>
                        <div>
                            <div style="display: inline-block">
                                <a href="{{ route('company-details.edit', ['id' => $companyDetail->id]) }}" class="btn btn-info">Edit</a>
                            </div>

                            <div style="display: inline-block">
                                <a href="{{ route('company-details.delete', ['id' => $companyDetail->id]) }}" class="btn btn-danger" >Delete</a>
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
