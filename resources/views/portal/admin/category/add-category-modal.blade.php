<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('category.store') }}" method="post">
                @csrf

                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="category_name">Category Name: <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" id="category_name" class="form-control" />
                        </div>

                        <button type="submit" class="btn" style=""></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #29babf; color: white" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
