@extends('portal.layout')
@section('title', 'Edit Order')

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
        <form action="{{ route('quote.update', ['quote' => $order->id]) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            @if($order->order_type == 'digitizing')
                <div class="card digitizing_ordr">
                    <div class="card-header">
                        <h5>Digitizing Order</h5>
                    </div>

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
                                                <input type="text" class="form-control" name="design_name" value="{{ $order->design_name }}" required id="design_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fabric">Select Fabric</label>
                                                <select class="form-control" name="fabric" required id="fabric">
                                                    <option selected disabled>Select Fabric</option>
                                                    <option value="Apron" {{ ($order->fabric == 'Apron') ? 'selected' : '' }}>Apron</option>
                                                    <option value="Blanket" {{ ($order->fabric == 'Blanket') ? 'selected' : '' }}>Blanket</option>
                                                    <option value="Canvas" {{ ($order->fabric == 'Canvas') ? 'selected' : '' }}>Canvas</option>
                                                    <option value="Cotton_Woven" {{ ($order->fabric == 'Cotton_Woven') ? 'selected' : '' }}>Cotton Woven</option>
                                                    <option value="Chenille" {{ ($order->fabric == 'Chenille') ? 'selected' : '' }}>Chenille</option>
                                                    <option value="Denim" {{ ($order->fabric == 'Denim') ? 'selected' : '' }}>Denim</option>
                                                    <option value="Felt" {{ ($order->fabric == 'Felt') ? 'selected' : '' }}>Felt</option>
                                                    <option value="Fleece" {{ ($order->fabric == 'Fleece') ? 'selected' : '' }}>Fleece</option>
                                                    <option value="Flannel" {{ ($order->fabric == 'Flannel') ? 'selected' : '' }}>Flannel</option>
                                                    <option value="Pique" {{ ($order->fabric == 'Pique') ? 'selected' : '' }}>Pique</option>
                                                    <option value="Single_Jersey" {{ ($order->fabric == 'Single_Jersey') ? 'selected' : '' }}>Single Jersey</option>
                                                    <option value="Silk" {{ ($order->fabric == 'Silk') ? 'selected' : '' }}>Silk</option>
                                                    <option value="Polyester" {{ ($order->fabric == 'Polyester') ? 'selected' : '' }}>Polyester</option>
                                                    <option value="knit_sweater" {{ ($order->fabric == 'knit_sweater') ? 'selected' : '' }}>knit sweater</option>
                                                    <option value="Twill" {{ ($order->fabric == 'Twill') ? 'selected' : '' }}>Twill</option>
                                                    <option value="Towel" {{ ($order->fabric == 'Towel') ? 'selected' : '' }}>Towel</option>
                                                    <option value="Leather" {{ ($order->fabric == 'Leather') ? 'selected' : '' }}>Leather</option>
                                                    <option value="Nylon" {{ ($order->fabric == 'Nylon') ? 'selected' : '' }}>Nylon</option>
                                                    <option value="polar_fleece" {{ ($order->fabric == 'polar_fleece') ? 'selected' : '' }}>polar fleece</option>
                                                    <option value="Mesh_knit" {{ ($order->fabric == 'Mesh_knit') ? 'selected' : '' }}>Mesh knit</option>
                                                    <option value="Beanie" {{ ($order->fabric == 'Beanie') ? 'selected' : '' }}>Beanie</option>
                                                    <option value="Stretchy_polyester_light_Knit_Fabric" {{ ($order->fabric == 'Stretchy_polyester_light_Knit_Fabric') ? 'selected' : '' }}>Stretchy polyester / light Knit Fabric</option>
                                                    <option value="Other" {{ ($order->fabric == 'Other') ? 'selected' : '' }}>Other</option>
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
                                                    <option value="Bags" {{ ($order->fabric == 'Bags') ? 'selected' : '' }}>Bags</option>
                                                    <option value="Cap" {{ ($order->fabric == 'Cap') ? 'selected' : '' }}>Cap</option>
                                                    <option value="Chest" {{ ($order->fabric == 'Chest') ? 'selected' : '' }}>Chest</option>
                                                    <option value="Gloves" {{ ($order->fabric == 'Gloves') ? 'selected' : '' }}>Gloves</option>
                                                    <option value="Cap_Side" {{ ($order->fabric == 'Cap_Side') ? 'selected' : '' }}>Cap Side</option>
                                                    <option value="Cap_Back" {{ ($order->fabric == 'Cap_Back') ? 'selected' : '' }}>Cap Back</option>
                                                    <option value="Towel" {{ ($order->fabric == 'Towel') ? 'selected' : '' }}>Towel</option>
                                                    <option value="JacketBack" {{ ($order->fabric == 'JacketBack') ? 'selected' : '' }}>JacketBack</option>
                                                    <option value="Sleeve" {{ ($order->fabric == 'Sleeve') ? 'selected' : '' }}>Sleeve</option>
                                                    <option value="Patches" {{ ($order->fabric == 'Patches') ? 'selected' : '' }}>Patches</option>
                                                    <option value="Visor" {{ ($order->fabric == 'Visor') ? 'selected' : '' }}>Visor </option>
                                                    <option value="Table_Cloth" {{ ($order->fabric == 'Table_Cloth') ? 'selected' : '' }}>Table Cloth</option>
                                                    <option value="Beanie_Caps" {{ ($order->fabric == 'Beanie_Caps') ? 'selected' : '' }}>Beanie Caps</option>
                                                    <option value="Apron" {{ ($order->fabric == 'Apron') ? 'selected' : '' }}>Apron</option>
                                                    <option value="other" {{ ($order->fabric == 'other') ? 'selected' : '' }}>other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="format">Select Format</label>
                                                <select class="form-control" name="format" required id="format">
                                                    <option selected disabled>Other</option>
                                                    <option value="100" {{ ($order->fabric == '100') ? 'selected' : '' }}>100</option>
                                                    <option value="cdr" {{ ($order->fabric == 'cdr') ? 'selected' : '' }}>cdr</option>
                                                    <option value="cnd" {{ ($order->fabric == 'cnd') ? 'selected' : '' }}>cnd</option>
                                                    <option value="dsb" {{ ($order->fabric == 'dsb') ? 'selected' : '' }}>dsb</option>
                                                    <option value="dst" {{ ($order->fabric == 'dst') ? 'selected' : '' }}>dst</option>
                                                    <option value="dsz" {{ ($order->fabric == 'dsz') ? 'selected' : '' }}>dsz</option>
                                                    <option value="emb" {{ ($order->fabric == 'emb') ? 'selected' : '' }}>emb</option>
                                                    <option value="exp" {{ ($order->fabric == 'exp') ? 'selected' : '' }}>exp</option>
                                                    <option value="jef" {{ ($order->fabric == 'jef') ? 'selected' : '' }}>jef</option>
                                                    <option value="ksm" {{ ($order->fabric == 'ksm') ? 'selected' : '' }}>ksm</option>
                                                    <option value="pes" {{ ($order->fabric == 'pes') ? 'selected' : '' }}>pes</option>
                                                    <option value="pof" {{ ($order->fabric == 'pof') ? 'selected' : '' }}>pof</option>
                                                    <option value="tap" {{ ($order->fabric == 'tap') ? 'selected' : '' }}>tap</option>
                                                    <option value="xxx" {{ ($order->fabric == 'xxx') ? 'selected' : '' }}>xxx</option>
                                                    <option value="ofm" {{ ($order->fabric == 'ofm') ? 'selected' : '' }}>ofm</option>
                                                    <option value="pxf" {{ ($order->fabric == 'pxf') ? 'selected' : '' }}>pxf</option>
                                                    <option value="sus" {{ ($order->fabric == 'sus') ? 'selected' : '' }}>sus</option>
                                                    <option value="hus" {{ ($order->fabric == 'hus') ? 'selected' : '' }}>hus</option>
                                                    <option value="ngs" {{ ($order->fabric == 'ngs') ? 'selected' : '' }}>ngs</option>
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
                                                <input type="number" class="form-control"  name="no_color" value="{{ $order->no_color }}" required id="no_color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="height">Height</label>
                                                <input type="text" class="form-control" name="height" value="{{ $order->height }}" required id="height" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="width">Width</label>
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" required id="width" />
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
                                                    <input type="radio" id="yes" name="urgent" {{ ($order->urgent == 'yes') ? 'checked' : '' }} value="yes"  />
                                                    <label class="tab" for="yes">Yes</label>

                                                    <input type="radio" id="no" name="urgent" {{ ($order->urgent == 'no') ? 'checked' : '' }} value="no" />
                                                    <label class="tab" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" name="price" value="{{ $order->price }}" required id="price" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="special_instruct">Special Instruction</label>
                                                <textarea class="form-control" id="special_instruct" name="special_instruct">{{ $order->special_instruct }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($order->order_type == 'vector')
                <div class="card vector_ordr">
                    <div class="card-header">
                        <h4>Vector Order</h4>
                    </div>

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
                                                <input type="text" class="form-control" name="design_name" value="{{ $order->design_name }}" required id="design_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_of_colors">No. of Colors</label>
                                                <input type="number" class="form-control" name="no_color" value="{{ $order->no_color }}" required id="no_of_colors">
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
                                                    <option value="PMS" {{ ($order->fabric == 'PMS') ? 'selected' : '' }}>PMS</option>
                                                    <option value="RGB" {{ ($order->fabric == 'RGB') ? 'selected' : '' }}>RGB</option>
                                                    <option value="CMYK" {{ ($order->fabric == 'CMYK') ? 'selected' : '' }}>CMYK</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="format">Select Format</label>
                                                <select class="form-control" name="format" required id="format">
                                                    <option selected disabled>Other</option>
                                                    <option value="ai" {{ ($order->fabric == 'ai') ? 'selected' : '' }}>ai</option>
                                                    <option value="cdr" {{ ($order->fabric == 'cdr') ? 'selected' : '' }}>cdr</option>
                                                    <option value="eps" {{ ($order->fabric == 'eps') ? 'selected' : '' }}>eps</option>
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
                                                    <p class="file-name"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="unloading_status">Urgent</label>

                                                <div>
                                                    <input type="radio" id="yes" name="urgent" {{ ($order->urgent == 'yes') ? 'checked' : '' }} value="yes" />
                                                    <label class="tab" for="yes">Yes</label>

                                                    <input type="radio" id="no" name="urgent" {{ ($order->urgent == 'no') ? 'checked' : '' }} value="no" />
                                                    <label class="tab" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ $order->price }}" required id="price" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="special_instruct">Special Instruction</label>
                                                <textarea class="form-control" id="special_instruct" name="special_instruct">{{ $order->special_instruct }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($order->order_type == 'patches')
                <div class="card patches_ordr">
                    <div class="card-header">
                        <h4>Patches Order</h4>
                    </div>

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
                                                <input type="text" class="form-control" name="design_name" value="{{ $order->design_name }}" required id="design_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="patch_type">Select Patch Type</label>
                                                <select class="form-control" name="patch_type" required id="patch_type">
                                                    <option selected disabled>Select Patch Type</option>
                                                    <option value="Embroidery" {{ ($order->fabric == 'Embroidery') ? 'selected' : '' }}>EMBROIDERY</option>
                                                    <option value="Chenille" {{ ($order->fabric == 'Chenille') ? 'selected' : '' }}>CHENILLE</option>
                                                    <option value="Printed" {{ ($order->fabric == 'Printed') ? 'selected' : '' }}>PRINTED</option>
                                                    <option value="Woven" {{ ($order->fabric == 'Woven') ? 'selected' : '' }}>WOVEN</option>
                                                    <option value="Bullion" {{ ($order->fabric == 'Bullion') ? 'selected' : '' }}>BULLION</option>
                                                    <option value="Denim" {{ ($order->fabric == 'Denim') ? 'selected' : '' }}>Denim</option>
                                                    <option value="name" {{ ($order->fabric == 'name') ? 'selected' : '' }}>NAME</option>
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
                                                <input type="number" class="form-control" name="no_color" value="{{ $order->no_color }}" required id="no_of_color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="height">Height</label>
                                                <input type="text" class="form-control" name="height" value="{{ $order->height }}" required id="height">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="width">Width</label>
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" required id="width">
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
                                                    <input type="radio" id="yes" name="urgent" value="yes" {{ ($order->urgent == 'yes') ? 'checked' : '' }} />
                                                    <label class="tab" for="yes">Yes</label>

                                                    <input type="radio" id="no" name="urgent" value="no" {{ ($order->urgent == 'no') ? 'checked' : '' }} />
                                                    <label class="tab" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ $order->price }}" required id="price" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="shipping_cost">Shipping Cost</label>
                                                <input type="number" class="form-control" name="shipping_cost" value="{{ $order->shippinhg_cost }}" required id="shipping_cost" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tracking_id">Tracking ID</label>
                                                <input type="text" class="form-control" name="tracking_id" value="{{ $order-> tracking_id}}" required id="tracking_id" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="special_instruct">Special Instruction</label>
                                                <textarea class="form-control" id="special_instruct" name="special_instruct">{{ $order->special_instruct }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($order->order_type == 'logo')
                <div class="card logo_order">
                    <div class="card-header">
                        <h4>Logo Order</h4>
                    </div>

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
                                                <input type="text" class="form-control" name="design_name" value="{{ $order->design_name }}" required id="design_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_of_color">No. of Colors</label>
                                                <input type="number" class="form-control" name="no_color" value="{{ $order->no_color }}" required id="no_of_color">
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
                                                <input type="text" class="form-control" name="height" value="{{ $order->height }}" required id="height">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="width">Width</label>
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" required id="width">
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
                                                    <input type="radio" id="yes" name="urgent" value="yes" {{ ($order->urgent == 'yes') ? 'checked' : '' }} />
                                                    <label class="tab" for="yes">Yes</label>

                                                    <input type="radio" id="no" name="urgent" value="no" {{ ($order->urgent == 'no') ? 'checked' : '' }} />
                                                    <label class="tab" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ $order->price }}" required id="price" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="shipping_cost">Shipping Cost</label>
                                                <input type="number" class="form-control" name="shipping_cost" value="{{ $order->shipping_cost }}" required id="shipping_cost" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tracking_id">Tracking ID</label>
                                                <input type="number" class="form-control" name="tracking_id" value="{{ $order->tracking_id }}" required id="tracking_id" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="special_instruct">Special Instruction</label>
                                                <textarea class="form-control" id="special_instruct" name="special_instruct">{{ $order->special_instruct }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($order->order_type == 'digitizing' || $order->order_type == 'vector' || $order->order_type == 'patches' || $order->order_type == 'logo')
                <div class="card" style="margin-bottom: 0">
                    <div class="card-body">
                        <div class="text-right">
                            <button type="submit" style="background-color: #29babf; color: white" class="btn">Update</button>
                        </div>
                    </div>
                </div>
            @else
                <h6 style="text-align: center">No Record Found.</h6>
            @endif
        </form>
    </div>
@endsection

@section('JS')
    <script>
        function selectImage(pointer){
            var file = $(pointer)[0].files[0].name;
            $('.file-name').text(file);
        }
    </script>
@endsection
