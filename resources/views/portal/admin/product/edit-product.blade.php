<!-- Modal -->
<div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" enctype="multipart/form-data" id="update_form">
                @method('put')
                @csrf

                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="product_category">Product Category: <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" id="e_product_category">
                                <option selected disabled>Select</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucwords($category->category_name) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="e_product_title">Product Title: <span class="text-danger">*</span></label>
                            <input type="text" name="product_title" id="e_product_title" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="e_product_description">Product Description: <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="product_description" id="e_product_description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Product Image</label> <br />
                            <input type="file" name="e_product_image" id="e_file-input" class="form-control" hidden  />
                            <label for="file-input" style="border: 1px solid #29babf; border-radius: 5px; padding: 10px; color: white; background-color: #29babf">+ Choose Image</label>
                            <div id="e_selected-image"></div>
                        </div>

                        <button type="submit" class="btn" style=""></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #29babf; color: white" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
