@extends('portal.layout')
@section('title', 'Edit Products')

@section('content')
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-6">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('product.update', ['product' => $product->id]) }}" enctype="multipart/form-data" id="update_form">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="e_product_category">Product Category: <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" id="e_product_category">
                            <option selected disabled>Select</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ ucwords($category->category_name) }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="e_product_title">Product Title: <span class="text-danger">*</span></label>
                        <input type="text" name="product_title" id="e_product_title" value="{{ ucwords($product->product_title) }}" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="e_product_description">Product Description: <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" name="product_description" id="e_product_description">{!! $product->product_description !!}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Product Image</label> <br />
                        <input type="file" name="product_image" id="e_file-input" class="form-control" hidden  />
                        <label for="e_file-input" style="border: 1px solid #29babf; border-radius: 5px; padding: 10px; color: white; background-color: #29babf">+ Choose Image</label>
                        <div id="e_selected-image"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Price Chart</label> <br />
                        <input type="file" name="price_chart" id="file-input2" class="form-control" hidden  />
                        <label for="file-input2" style="border: 1px solid #29babf; border-radius: 5px; padding: 10px; color: white; background-color: #29babf">+ Choose Image</label>
                        <div id="selected-image2"></div>
                    </div>

                    <button type="submit" style="background-color: #29babf; color: white" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        const efileInput = document.getElementById('e_file-input');
        const eselectedImage = document.getElementById('e_selected-image');

        efileInput.addEventListener('change', function() {
            eselectedImage.textContent = `${efileInput.files[0].name}`;
        });

        const efileInput2 = document.getElementById('file-input2');
        const eselectedImage2 = document.getElementById('selected-image2');

        efileInput2.addEventListener('change', function() {
            eselectedImage2.textContent = `${efileInput2.files[0].name}`;
        });

        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection
