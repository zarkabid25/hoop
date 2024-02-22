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
        <form action="{{ route('order.update', ['order' => $order->id]) }}" method="post" enctype="multipart/form-data">
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
                                                <select class="form-control js-example-tags" name="fabric" required id="fabric">
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
                                                    <option value="Hoodie" {{ ($order->fabric == 'Hoodie') ? 'selected' : '' }}>Hoodie</option>
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
                                                <select class="form-control js-example-tags" name="placement" required id="placement">
                                                    <option selected disabled>Select Placement</option>
                                                    <option value="Bags" {{ ($order->placement == 'Bags') ? 'selected' : '' }}>Bags</option>
                                                    <option value="Cap" {{ ($order->placement == 'Cap') ? 'selected' : '' }}>Cap</option>
                                                    <option value="Chest" {{ ($order->placement == 'Chest') ? 'selected' : '' }}>Chest</option>
                                                    <option value="Gloves" {{ ($order->placement == 'Gloves') ? 'selected' : '' }}>Gloves</option>
                                                    <option value="Cap_Side" {{ ($order->placement == 'Cap_Side') ? 'selected' : '' }}>Cap Side</option>
                                                    <option value="Cap_Back" {{ ($order->placement == 'Cap_Back') ? 'selected' : '' }}>Cap Back</option>
                                                    <option value="Towel" {{ ($order->placement == 'Towel') ? 'selected' : '' }}>Towel</option>
                                                    <option value="JacketBack" {{ ($order->placement == 'JacketBack') ? 'selected' : '' }}>JacketBack</option>
                                                    <option value="Sleeve" {{ ($order->placement == 'Sleeve') ? 'selected' : '' }}>Sleeve</option>
                                                    <option value="Patches" {{ ($order->placement == 'Patches') ? 'selected' : '' }}>Patches</option>
                                                    <option value="Visor" {{ ($order->placement == 'Visor') ? 'selected' : '' }}>Visor </option>
                                                    <option value="Table_Cloth" {{ ($order->placement == 'Table_Cloth') ? 'selected' : '' }}>Table Cloth</option>
                                                    <option value="Beanie_Caps" {{ ($order->placement == 'Beanie_Caps') ? 'selected' : '' }}>Beanie Caps</option>
                                                    <option value="Apron" {{ ($order->placement == 'Apron') ? 'selected' : '' }}>Apron</option>
                                                    <option value="other" {{ ($order->placement == 'other') ? 'selected' : '' }}>other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="format">Select Format</label>
                                                <select class="form-control js-example-tags" name="format[]" id="format" required multiple="multiple">
                                                    <option value="other" {{ (in_array('other', $order->format)) ? 'selected' : '' }}>Other</option>
                                                    <option value="100" {{ (in_array('100', $order->format)) ? 'selected' : '' }}>100</option>
                                                    <option value="cdr" {{ (in_array('cdr', $order->format)) ? 'selected' : '' }}>cdr</option>
                                                    <option value="cnd" {{ (in_array('cnd', $order->format)) ? 'selected' : '' }}>cnd</option>
                                                    <option value="dsb" {{ (in_array('dsb', $order->format)) ? 'selected' : '' }}>dsb</option>
                                                    <option value="dst" {{ (in_array('dst', $order->format)) ? 'selected' : '' }}>dst</option>
                                                    <option value="dsz" {{ (in_array('dsz', $order->format)) ? 'selected' : '' }}>dsz</option>
                                                    <option value="emb" {{ (in_array('emb', $order->format)) ? 'selected' : '' }}>emb</option>
                                                    <option value="exp" {{ (in_array('exp', $order->format)) ? 'selected' : '' }}>exp</option>
                                                    <option value="jef" {{ (in_array('jef', $order->format)) ? 'selected' : '' }}>jef</option>
                                                    <option value="ksm" {{ (in_array('ksm', $order->format)) ? 'selected' : '' }}>ksm</option>
                                                    <option value="pes" {{ (in_array('pes', $order->format)) ? 'selected' : '' }}>pes</option>
                                                    <option value="pdf" {{ (in_array('pdf', $order->format)) ? 'selected' : '' }}>pdf</option>
                                                    <option value="tap" {{ (in_array('tap', $order->format)) ? 'selected' : '' }}>tap</option>
                                                    <option value="xxx" {{ (in_array('xxx', $order->format)) ? 'selected' : '' }}>xxx</option>
                                                    <option value="ofm" {{ (in_array('ofm', $order->format)) ? 'selected' : '' }}>ofm</option>
                                                    <option value="pxf" {{ (in_array('pxf', $order->format)) ? 'selected' : '' }}>pxf</option>
                                                    <option value="sus" {{ (in_array('sus', $order->format)) ? 'selected' : '' }}>sus</option>
                                                    <option value="hus" {{ (in_array('hus', $order->format)) ? 'selected' : '' }}>hus</option>
                                                    <option value="ngs" {{ (in_array('ngs', $order->format)) ? 'selected' : '' }}>ngs</option>
                                                    <option value="jpg" {{ (in_array('jpg', $order->format)) ? 'selected' : '' }}>jpg</option>
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
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" id="width" />
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
                                                    <input type="file" name="order_img[]" id="upload" onchange="selectImage(this);" accept=".jpg,.pdf, .dst, .png" multiple hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
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

            @if($order->order_type == 'other')
                <div class="card">
                    <div class="card-header">
                        <h5>Other</h5>
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
                                                <select class="form-control js-example-tags" name="fabric" required id="fabric">
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
                                                    <option value="Hoodie" {{ ($order->fabric == 'Hoodie') ? 'selected' : '' }}>Hoodie</option>
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
                                                <select class="form-control js-example-tags" name="placement" required id="placement">
                                                    <option selected disabled>Select Placement</option>
                                                    <option value="bags" {{ ($order->placement == 'bags') ? 'selected' : '' }}>Bags</option>
                                                    <option value="cap" {{ ($order->placement == 'cap') ? 'selected' : '' }}>Cap</option>
                                                    <option value="chest" {{ ($order->placement == 'chest') ? 'selected' : '' }}>Chest</option>
                                                    <option value="gloves" {{ ($order->placement == 'cloves') ? 'selected' : '' }}>Gloves</option>
                                                    <option value="cap_side" {{ ($order->placement == 'cap_side') ? 'selected' : '' }}>Cap Side</option>
                                                    <option value=cap_back" {{ ($order->placement == 'cap_back') ? 'selected' : '' }}>Cap Back</option>
                                                    <option value="towel" {{ ($order->placement == 'towel') ? 'selected' : '' }}>Towel</option>
                                                    <option value="jacketback" {{ ($order->placement == 'jacketback') ? 'selected' : '' }}>JacketBack</option>
                                                    <option value="sleeve" {{ ($order->placement == 'sleeve') ? 'selected' : '' }}>Sleeve</option>
                                                    <option value="patches" {{ ($order->placement == 'patches') ? 'selected' : '' }}>Patches</option>
                                                    <option value="visor" {{ ($order->placement == 'visor') ? 'selected' : '' }}>Visor </option>
                                                    <option value="table_cloth" {{ ($order->placement == 'table_cloth') ? 'selected' : '' }}>Table Cloth</option>
                                                    <option value="beanie_caps" {{ ($order->placement == 'beanie_caps') ? 'selected' : '' }}>Beanie Caps</option>
                                                    <option value="apron" {{ ($order->placement == 'apron') ? 'selected' : '' }}>Apron</option>
                                                    <option value="other" {{ ($order->placement == 'other') ? 'selected' : '' }}>other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="format">Select Format</label>
                                            <select class="form-control js-example-tags" name="format[]" id="format" required multiple="multiple">
                                                <option value="other" {{ (in_array('other', $order->format)) ? 'selected' : '' }}>Other</option>
                                                <option value="100" {{ (in_array('100', $order->format)) ? 'selected' : '' }}>100</option>
                                                <option value="cdr" {{ (in_array('cdr', $order->format)) ? 'selected' : '' }}>cdr</option>
                                                <option value="cnd" {{ (in_array('cnd', $order->format)) ? 'selected' : '' }}>cnd</option>
                                                <option value="dsb" {{ (in_array('dsb', $order->format)) ? 'selected' : '' }}>dsb</option>
                                                <option value="dst" {{ (in_array('dst', $order->format)) ? 'selected' : '' }}>dst</option>
                                                <option value="dsz" {{ (in_array('dsz', $order->format)) ? 'selected' : '' }}>dsz</option>
                                                <option value="emb" {{ (in_array('emb', $order->format)) ? 'selected' : '' }}>emb</option>
                                                <option value="exp" {{ (in_array('exp', $order->format)) ? 'selected' : '' }}>exp</option>
                                                <option value="jef" {{ (in_array('jef', $order->format)) ? 'selected' : '' }}>jef</option>
                                                <option value="ksm" {{ (in_array('ksm', $order->format)) ? 'selected' : '' }}>ksm</option>
                                                <option value="pes" {{ (in_array('pes', $order->format)) ? 'selected' : '' }}>pes</option>
                                                <option value="pdf" {{ (in_array('pdf', $order->format)) ? 'selected' : '' }}>pdf</option>
                                                <option value="tap" {{ (in_array('tap', $order->format)) ? 'selected' : '' }}>tap</option>
                                                <option value="xxx" {{ (in_array('xxx', $order->format)) ? 'selected' : '' }}>xxx</option>
                                                <option value="ofm" {{ (in_array('ofm', $order->format)) ? 'selected' : '' }}>ofm</option>
                                                <option value="pxf" {{ (in_array('pxf', $order->format)) ? 'selected' : '' }}>pxf</option>
                                                <option value="sus" {{ (in_array('sus', $order->format)) ? 'selected' : '' }}>sus</option>
                                                <option value="hus" {{ (in_array('hus', $order->format)) ? 'selected' : '' }}>hus</option>
                                                <option value="ngs" {{ (in_array('ngs', $order->format)) ? 'selected' : '' }}>ngs</option>
                                                <option value="jpg" {{ (in_array('jpg', $order->format)) ? 'selected' : '' }}>jpg</option>
                                            </select>
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
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" id="width" />
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
                                                    <input type="file" name="order_img[]" id="upload" onchange="selectImage(this);" accept=".jpg,.pdf, .dst, .png" multiple hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
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
                                                    <option value="PMS" {{ ($order->color_type == 'PMS') ? 'selected' : '' }}>PMS</option>
                                                    <option value="RGB" {{ ($order->color_type == 'RGB') ? 'selected' : '' }}>RGB</option>
                                                    <option value="CMYK" {{ ($order->color_type == 'CMYK') ? 'selected' : '' }}>CMYK</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="format">Select Format</label>
                                                <select class="form-control js-example-tags" name="format[]" required id="format" multiple="multiple">
                                                    <option value="other" {{ (in_array('other', $order->format)) ? 'selected' : '' }}>Other</option>
                                                    <option value="ai" {{ (in_array('ai', $order->format)) ? 'selected' : '' }}>ai</option>
                                                    <option value="cdr" {{ (in_array('cdr', $order->format)) ? 'selected' : '' }}>cdr</option>
                                                    <option value="eps" {{ (in_array('eps', $order->format)) ? 'selected' : '' }}>eps</option>
                                                    <option value="pdf" {{ (in_array('pdf', $order->format)) ? 'selected' : '' }}>pdf</option>
                                                    <option value="jpg" {{ (in_array('jpg', $order->format)) ? 'selected' : '' }}>jpg</option>
                                                    <option value="png" {{ (in_array('png', $order->format)) ? 'selected' : '' }}>png</option>
                                                    <option value="svg" {{ (in_array('svg', $order->format)) ? 'selected' : '' }}>svg</option>
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
                                                    <input type="file" name="order_img[]" id="upload" onchange="selectImage(this);" accept=".ai,.eps, .pdf, .jpg, .png" multiple hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
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
                                                    <option value="Embroidery" {{ ($order->patch_type == 'Embroidery') ? 'selected' : '' }}>EMBROIDERY</option>
                                                    <option value="Chenille" {{ ($order->patch_type == 'Chenille') ? 'selected' : '' }}>CHENILLE</option>
                                                    <option value="Printed" {{ ($order->patch_type == 'Printed') ? 'selected' : '' }}>PRINTED</option>
                                                    <option value="Woven" {{ ($order->patch_type == 'Woven') ? 'selected' : '' }}>WOVEN</option>
                                                    <option value="Bullion" {{ ($order->patch_type == 'Bullion') ? 'selected' : '' }}>BULLION</option>
                                                    <option value="Denim" {{ ($order->patch_type == 'Denim') ? 'selected' : '' }}>Denim</option>
                                                    <option value="name" {{ ($order->patch_type == 'name') ? 'selected' : '' }}>NAME</option>
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
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" id="width">
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
                                                    <input type="file" name="order_img[]" id="upload" onchange="selectImage(this);" multiple hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
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
                                                <input type="text" class="form-control" name="width" value="{{ $order->width }}" id="width">
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
                                                    <input type="file" name="order_img[]" id="upload" onchange="selectImage(this);" multiple hidden/>
                                                    <label class="choose_file" for="upload">+ Choose file</label>
                                                    <p class="file-name"></p>
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

            @if($order->order_type == 'digitizing' || $order->order_type == 'vector' || $order->order_type == 'patches' || $order->order_type == 'logo' || $order->order_type == 'other')
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
        $(document).ready(function (){
            $(".js-example-tags").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        })

        function selectImage(input) {
            var files = input.files;
            var fileNames = [];

            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }

            $(".file-name").text(fileNames.join(', '));
        }
    </script>
@endsection
