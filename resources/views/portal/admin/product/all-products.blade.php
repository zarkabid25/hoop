@extends('portal.layout')
@section('title', 'All Products')

@section('content')
    <div class="container">
        <div class="text-right mb-4">
            <a href="{{ route('product.create') }}" class="btn btn-outline-danger">+ Add Product</a>
        </div>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Sr.#</th>
                    <th>Product Title</th>
{{--                    <th>Product Description</th>--}}
                    <th>Image</th>
                    <th>Price Chart</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp

            @forelse($products as $product)
                @php
                    $img = $product->product_image ?? 'No-Image.png';
                    $img2 = $product->price_chart ?? 'No-Image.png';
                @endphp
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ ucwords($product->product_title) }}</td>
{{--                    <td>{!! mb_strimwidth($product->product_description, 0, 70, "...") !!}</td>--}}
                    <td>
                        <img src="{{ asset('images'. '/' .$img) }}" alt="" width="100" />
                    </td>
                    <td>
                        <img src="{{ asset('images'. '/' .$img2) }}" alt="" width="100" />
                    </td>
                    <td>
                        <div>
                            <div style="display: inline-block">
                                <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-info">Edit</a>
                            </div>

                            <div style="display: inline-block">
                                <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="post" class="delete_form">
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

{{--    @include('portal.admin.product.add-product')--}}
{{--    @include('portal.admin.product.edit-product')--}}
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

        const fileInput = document.getElementById('file-input');
        const selectedImage = document.getElementById('selected-image');

        fileInput.addEventListener('change', function() {
            selectedImage.textContent = `${fileInput.files[0].name}`;
        });

        const efileInput = document.getElementById('e_file-input');
        const eselectedImage = document.getElementById('e_selected-image');

        efileInput.addEventListener('change', function() {
            eselectedImage.textContent = `${efileInput.files[0].name}`;
        });



        {{--function editCat(id){--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('product.edit', ['product' => ':id']) }}'.replace(':id', id),--}}
        {{--        type: 'GET',--}}
        {{--        dataType: 'JSON',--}}
        {{--        data: {id: id},--}}
        {{--        success: function (response){--}}
        {{--            $('#update_form').attr('action', '{{ route('product.update', ['product' => ':id']) }}'.replace(':id', response.product.id));--}}

        {{--            $('#e_product_title').val(response.product.product_title);--}}
        {{--            $('#e_product_description').text(response.product.product_description);--}}
        {{--            $.each(response.categories, function(key, val) {--}}
        {{--                var isSelected = (val.id === response.product.category_id) ? 'selected' : '';--}}
        {{--                $('#e_product_category').empty();--}}
        {{--                $('#e_product_category').append(`--}}
        {{--                    <option value="${val.id}" ${isSelected}>${val.category_name}</option>--}}
        {{--                `);--}}
        {{--            });--}}

        {{--            $('#edit-product').modal('show');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection
