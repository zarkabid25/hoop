@extends('portal.layout')
@section('title', 'Create Quote')

@section('css')
    <style>
        .choose_file{
            display: inline-block;
            background-color: #29babf;
            color: white;
            padding: 0.5rem;
            font-family: sans-serif;
            border-radius: 0.3rem;
            cursor: pointer;
            /*margin-top: 1rem;*/
        }

        input[type="radio"] {
            display: none;
        }

        .tab {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
        }

        input[type="radio"]:checked + .tab {
            background-color: #29babf;
            color: white;
        }
        .form-control{
            font-size: 0.8rem;
        }

        label{
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('quote.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="append_form">
                <div class="card digitizing_ordr">
                    <div class="card-header">
                        <h5>Digitizing Quote</h5>
                    </div>

                    <input type="hidden" name="quote_type" value="digitizing" />
                    <div class="card-body">
                        <div class="digi_order">
                            <div class="card shadow">
                                <div class="card-header bg-cyan">
                                    <h6>Design</h6>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="design_name">Design Name</label>
                                                <input type="text" class="form-control" name="design_name" placeholder="Your Desgin Name" required id="design_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fabric">Select Fabric</label>
                                                <select class="form-control" name="fabric" required id="fabric">
                                                    <option selected disabled>Select Fabric</option>
                                                    <option value="Apron">Apron</option>
                                                    <option value="Blanket">Blanket</option>
                                                    <option value="Canvas">Canvas</option>
                                                    <option value="Cotton_Woven">Cotton Woven</option>
                                                    <option value="Chenille">Chenille</option>
                                                    <option value="Denim">Denim</option>
                                                    <option value="Felt">Felt</option>
                                                    <option value="Fleece">Fleece</option>
                                                    <option value="Flannel">Flannel</option>
                                                    <option value="Pique">Pique</option>
                                                    <option value="Single_Jersey">Single Jersey</option>
                                                    <option value="Silk">Silk</option>
                                                    <option value="Polyester">Polyester</option>
                                                    <option value="knit_sweater">knit sweater</option>
                                                    <option value="Twill">Twill</option>
                                                    <option value="Towel">Towel</option>
                                                    <option value="Leather">Leather</option>
                                                    <option value="Nylon">Nylon</option>
                                                    <option value="polar_fleece">polar fleece</option>
                                                    <option value="Mesh_knit">Mesh knit</option>
                                                    <option value="Beanie">Beanie</option>
                                                    <option value="Stretchy_polyester_light_Knit_Fabric">Stretchy polyester / light Knit Fabric</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="placement">Select Placement</label>
                                                <select class="form-control" name="placement" required id="placement">
                                                    <option selected disabled>Select Placement</option>
                                                    <option value="Bags">Bags</option>
                                                    <option value="Cap">Cap</option>
                                                    <option value="Chest">Chest</option>
                                                    <option value="Gloves">Gloves</option>
                                                    <option value="Cap Side">Cap Side</option>
                                                    <option value="Cap Back">Cap Back</option>
                                                    <option value="Towel">Towel</option>
                                                    <option value="JacketBack">JacketBack</option>
                                                    <option value="Sleeve">Sleeve</option>
                                                    <option value="Patches">Patches</option>
                                                    <option value="Visor ">Visor </option>
                                                    <option value="Table Cloth">Table Cloth</option>
                                                    <option value="Beanie Caps">Beanie Caps</option>
                                                    <option value="Apron">Apron</option>
                                                    <option value="other">other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="format">Select Format</label>
                                                <select class="form-control" name="format" required id="format">
                                                    <option selected disabled>Other</option>
                                                    <option value="100">100</option>
                                                    <option value="cdr">cdr</option>
                                                    <option value="cnd">cnd</option>
                                                    <option value="dsb">dsb</option>
                                                    <option value="dst">dst</option>
                                                    <option value="dsz">dsz</option>
                                                    <option value="emb">emb</option>
                                                    <option value="exp">exp</option>
                                                    <option value="jef">jef</option>
                                                    <option value="ksm">ksm</option>
                                                    <option value="pes">pes</option>
                                                    <option value="pof">pof</option>
                                                    <option value="tap">tap</option>
                                                    <option value="xxx">xxx</option>
                                                    <option value="ofm">ofm</option>
                                                    <option value="pxf">pxf</option>
                                                    <option value="sus">sus</option>
                                                    <option value="hus">hus</option>
                                                    <option value="ngs">ngs</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow">
                                <div class="card-header bg-cyan">
                                    <h6>More Details</h6>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="no_color">No. of Colors</label>
                                                <input type="number" class="form-control"  name="no_color" placeholder="Enter the number of colors" required id="no_color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="height">Height</label>
                                                <input type="text" class="form-control" name="height" placeholder="Height" required id="height" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="width">Width</label>
                                                <input type="text" class="form-control" name="width" placeholder="Width" required id="width" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow">
                                <div class="card-header bg-cyan">
                                    <h6>Order</h6>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Upload File</label>
                                                <div>
                                                    <input type="file" name="order_img" id="upload" onchange="selectImage(this);" hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="unloading_status">Urgent</label>

                                                <div>
                                                    <input type="radio" id="yes" name="urgent" value="yes" checked />
                                                    <label class="tab" for="yes">Yes</label>

                                                    <input type="radio" id="no" name="urgent" value="no" />
                                                    <label class="tab" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Price" required id="price" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="special_instruct">Special Instruction</label>
                                                <textarea class="form-control" id="special_instruct" name="special_instruct"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 0">
                <div class="card-body">
                    <div class="text-right">
                        <button type="submit" style="background-color: #29babf; color: white" class="btn">Send Quote</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('portal.customer.quotes.quote-type')
@endsection



@section('JS')
    <script>
        $(document).ready(function (){
           $('#exampleModal').modal('show');
        });

        function selectImage(pointer){
            var file = $(pointer)[0].files[0].name;
            $('.file-name').text(file);
        }

        $('#order_procceed').on('click', function (){
           let type = $('#order_type').val();

           if(type === 'vector_order'){
               $('.append_form').replaceWith(`
                    <div class="card vector_ordr">
                <div class="card-header">
                    <h4>Vector Quote</h4>
                </div>

                <div class="card-body">
                    <div class="vector_order">
                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Design</h6>
                            </div>

                            <input type="hidden" name="order_type" value="vector" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="design_name">Design Name</label>
                                            <input type="text" class="form-control" name="design_name" placeholder="Your Desgin Name" required id="design_name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_of_colors">No. of Colors</label>
                                            <input type="number" class="form-control" name="no_color" placeholder="Enter the number of colors" required id="no_of_colors">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>More Details</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color_type">Colors Type</label>
                                            <select class="form-control" name="color_type" required id="color_type">
                                                <option selected disabled>Select Color Type</option>
                                                <option value="PMS">PMS</option>
                                                <option value="RGB">RGB</option>
                                                <option value="CMYK">CMYK</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="format">Select Format</label>
                                            <select class="form-control" name="format" required id="format">
                                                <option selected disabled>Other</option>
                                                <option value="ai">ai</option>
                                                <option value="cdr">cdr</option>
                                                <option value="eps">eps</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Order</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Upload File</label>
                                            <div>
                                                <input type="file" name="order_img" id="upload" onchange="selectImage(this);" hidden/>
                                                <label class="choose_file" for="upload">+ Choose file</label>
                                                <p class="file-name"></p
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unloading_status">Urgent</label>

                                            <div>
                                                <input type="radio" id="yes" name="urgent" value="yes" checked />
                                                <label class="tab" for="yes">Yes</label>

                                                <input type="radio" id="no" name="urgent" value="no" />
                                                <label class="tab" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="Price" required id="price" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="special_instruct">Special Instruction</label>
                                            <textarea class="form-control" id="special_instruct" name="special_instruct"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               `);
           }

           if(type === 'patches_order'){
               $('.append_form').replaceWith(`
                    <div class="card patches_ordr">
                <div class="card-header">
                    <h4>Patches Quote</h4>
                </div>

                <div class="card-body">
                    <div class="vector_order">
                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Design</h6>
                            </div>

                            <input type="hidden" name="order_type" value="patches" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="design_name">Design Name</label>
                                            <input type="text" class="form-control" name="design_name" placeholder="Your Desgin Name" required id="design_name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patch_type">Select Patch Type</label>
                                            <select class="form-control" name="patch_type" required id="patch_type">
                                                <option selected disabled>Select Patch Type</option>
                                                <option value="Embroidery">EMBROIDERY</option>
                                                <option value="Chenille">CHENILLE</option>
                                                <option value="Printed">PRINTED</option>
                                                <option value="Woven">WOVEN</option>
                                                <option value="Bullion">BULLION</option>
                                                <option value="Denim">Denim</option>
                                                <option value="name">NAME</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>More Details</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="no_of_color">No. of Colors</label>
                                            <input type="number" class="form-control" name="no_color" placeholder="Enter the number of colors" required id="no_of_color">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">Height</label>
                                            <input type="text" class="form-control" name="height" placeholder="Height" required id="height">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="width">Width</label>
                                            <input type="text" class="form-control" name="width" placeholder="Width" required id="width">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Order</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Upload File</label>
                                            <div>
                                                <input type="file" name="order_img" id="upload" onchange="selectImage(this);" hidden/>
                                                <label class="choose_file" for="upload">+ Choose file</label>
                                                <p class="file-name"></p
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unloading_status">Urgent</label>

                                            <div>
                                                <input type="radio" id="yes" name="urgent" value="yes" checked />
                                                <label class="tab" for="yes">Yes</label>

                                                <input type="radio" id="no" name="urgent" value="no" />
                                                <label class="tab" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="Price" required id="price" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shipping_cost">Shipping Cost</label>
                                            <input type="number" class="form-control" name="shipping_cost" placeholder="Price of shipment" required id="shipping_cost" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tracking_id">Tracking ID</label>
                                            <input type="text" class="form-control" name="tracking_id" placeholder="Enter Tracking ID" required id="tracking_id" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="special_instruct">Special Instruction</label>
                                            <textarea class="form-control" id="special_instruct" name="special_instruct"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               `);
           }
           if(type === 'logo_order'){
               $('.append_form').replaceWith(`
                    <div class="card logo_order">
                <div class="card-header">
                    <h4>Logo Quote</h4>
                </div>

                <input type="hidden" name="order_type" value="logo" />
                <div class="card-body">
                    <div class="vector_order">
                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Design</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="design_name">Design Name</label>
                                            <input type="text" class="form-control" name="design_name" placeholder="Your Desgin Name" required id="design_name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_of_color">No. of Colors</label>
                                            <input type="number" class="form-control" name="no_color" placeholder="Enter the number of colors" required id="no_of_color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>More Details</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">Height</label>
                                            <input type="text" class="form-control" name="height" placeholder="Height" required id="height">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="width">Width</label>
                                            <input type="text" class="form-control" name="width" placeholder="Width" required id="width">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header bg-cyan">
                                <h6>Order</h6>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Upload File</label>
                                            <div>
                                                <input type="file" name="order_img" id="upload" onchange="selectImage(this);" hidden/>
                                                <label class="choose_file" for="upload">+ Choose file</label>
                                                <p class="file-name"></p
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unloading_status">Urgent</label>

                                            <div>
                                                <input type="radio" id="yes" name="urgent" value="yes" checked />
                                                <label class="tab" for="yes">Yes</label>

                                                <input type="radio" id="no" name="urgent" value="no" />
                                                <label class="tab" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="Price" required id="price" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shipping_cost">Shipping Cost</label>
                                            <input type="number" class="form-control" name="shipping_cost" placeholder="Price of shipment" required id="shipping_cost" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tracking_id">Tracking ID</label>
                                            <input type="number" class="form-control" name="tracking_id" placeholder="Enter Tracking ID" required id="tracking_id" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="special_instruct">Special Instruction</label>
                                            <textarea class="form-control" id="special_instruct" name="special_instruct"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               `);
           }

            $('#exampleModal').modal('toggle');
        });
    </script>
@endsection
