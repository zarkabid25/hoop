<!-- Modal -->
<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="post" id="update_form">
                @method('put')
                @csrf

                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="edit_category_name">Category Name: <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" id="edit_category_name" class="form-control" />
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
