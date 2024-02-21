@extends('portal.layout')
@section('title', 'Company Details')

@section('content')
    <div class="container pb-5">
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <button type="button" id="add-fields" class="btn" style="color: white; background-color: #17a2b8">+ Add Fields</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6>Edit Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('company-details.update', ['id' => $record->id]) }}" method="post">
                    @csrf
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $record->field_title }}" name="field_title"  required/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $record->field_value }}" name="field_value"  placeholder="Field Value" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="child_fields"></div>

                    <div class="">
                        <button type="submit" style="background-color: #29babf; color: white" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        $('#add-fields').on('click', function (){
            $('#child_fields').append(`
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="field_title[]"  placeholder="Field Title" required/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="field_value[]"  placeholder="Field Value" required/>
                    </div>
                </div>
            `);
        })
    </script>
@endsection
