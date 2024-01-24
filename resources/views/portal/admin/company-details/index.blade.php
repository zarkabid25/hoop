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
            </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp

            @forelse($companyDetails as $companyDetail)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ ucwords($category->category_name) }}</td>
                    <td>
                        <div>
                            <div style="display: inline-block">
                                <a href="javascript:void(0);" class="btn btn-info" onclick="editCat({{ $category->id }});">Edit</a>
                            </div>

                            <div style="display: inline-block">
                                <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post" class="delete">
                                    @method('delete')
                                    @csrf

                                    <button type="button" class="btn btn-danger del_btn">Delete</button>
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
