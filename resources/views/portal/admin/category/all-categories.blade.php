@extends('portal.layout')

@section('title', 'Categories')

@section('content')
    <div class="container">
        <div class="text-right mb-4">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">+ Add Category</button>
        </div>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Sr.#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp

            @forelse($categories as $category)
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

    @include('portal.admin.category.add-category-modal')
    @include('portal.admin.category.edit-category-modal')
@endsection

@section('JS')
    <script>
        new DataTable('#example');

        $('.del_btn').on('click', function(e) {
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
                    $('.delete').submit();
                }
            });
        });

        function editCat(id){
            $.ajax({
               url: '{{ route('category.edit', ['category' => ':id']) }}'.replace(':id', id),
               type: 'GET',
               dataType: 'JSON',
               data: {id: id},
               success: function (response){
                   $('#update_form').attr('action', '{{ route('category.update', ['category' => ':id']) }}'.replace(':id', response.data.id));
                   $('#edit_category_name').val(response.data.category_name);
                   $('#edit_category_modal').modal('show');
               }
            });
        }
    </script>
@endsection
