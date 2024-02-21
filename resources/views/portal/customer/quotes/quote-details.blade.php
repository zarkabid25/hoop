@extends('portal.layout')
@section('title', 'All Order')

@section('content')
    <div class="container">
        @if(!empty($order))
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            <h6>Design</h6>
                        </div>

                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>Customer Name: </th>
                                    <td>{{ ucwords($order->customer->name) }}</td>
                                </tr>

                                <tr>
                                    <th>Design Name: </th>
                                    <td>{{ $order->design_name ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Fabric: </th>
                                    <td>{{ $order->fabric ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Placement: </th>
                                    <td>{{ $order->placement ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Format: </th>
                                    @php
                                        $formats = json_decode($order->format);
                                    @endphp
                                    <td>
                                        @forelse($formats as $format)
                                            <span class="badge badge-secondary">{{ $format }}</span>
                                        @empty
                                        @endforelse
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            <h6>More Details</h6>
                        </div>

                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>No. of Colors: </th>
                                    <td>{{ $order->no_color ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Height: </th>
                                    <td>{{ $order->height ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Width: </th>
                                    <td>{{ $order->width ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Colors Type: </th>
                                    <td>{{ $order->color_type ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Patch Type: </th>
                                    <td>{{ $order->patch_type ?? '--' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            <h6>Order</h6>
                        </div>

                        <div class="card-body">
                            @php
                                $img = json_decode($order->image);

                                if ($img == null) {
                                    $img = $order->image ?? 'no-file.png';
                                }
                            @endphp
{{--                            @php--}}
{{--                            --}}
{{--                                $img = $order->image ?? 'No-Image.png';--}}
{{--                            @endphp--}}

                            <table>
                                <tr>
                                    <th>Order Type: </th>
                                    <td>{{ ucfirst($order->order_type). ' Order' ?? '--' }}</td>
                                </tr>

                                <tr>
                                    @if(auth()->user()->role == 'admin' || request()->route()->getName() != 'quote.show')
                                        <th>Order Status: </th>
                                        <td>
                                            <select name="order_status" class="form-control" id="order_status">
                                                <option value="0" {{ ($order->order_status == '0') ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ ($order->order_status == '1') ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ ($order->order_status == '2') ? 'selected' : '' }}>Cancel</option>
                                            </select>
                                        </td>
                                    @else
                                        @if(request()->route()->getName() != 'quote.show')
                                            <th>Order Status: </th>
                                            <td>@if($order->order_status == '0') Pending @elseif ($order->order_status == '1') Approved @else Cancelled @endif</td>
                                        @endif
                                    @endif
                                </tr>

                                @php
                                    $placements = $order->customer->placements->toArray();
                                    if(array_key_exists($order->placement, $placements)){
                                        $matchingValue = $placements[$order->placement];
                                    }
                                    else{
                                        $matchingValue = '--';
                                    }
                                @endphp
                                <tr>
                                    <th>Price: </th>
                                    <td>{{ $matchingValue }}</td>
                                </tr>

                                <tr>
                                    <th>Shipping Cost: </th>
                                    <td>{{ $order->shipping_cost ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>Tracking ID</th>
                                    <td>{{ $order->tracking_id ?? '--' }}</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th>Special Instruction: </th>
                                    <td>{{ $order->special_instruct ?? '--' }}</td>
                                </tr>

                                <tr>
                                    <th>File: </th>
                                    <td>
{{--                                        <img src="{{ asset('images'. "/". $img) }}" alt="No Image" width="60" />--}}
                                        @if(is_array($img))
                                            @foreach($img as $val)
                                                <a href="{{ route('image.download', ['filename' => $val]) }}">{{ $val }}</a>
                                                {{--                                                <a href="{{ asset('images'. "/". $val) }}">{{ $val }}</a><br />--}}
                                            @endforeach
                                        @else
                                            <a href="{{ route('image.download', ['filename' => $img]) }}">{{ $img }}</a>
                                            {{--                                            <a href="{{ asset('images'. "/". $img) }}">{{ $img }}<a>--}}
                                            {{--                                            <img src="{{ asset('images'. "/". $img) }}" alt="No Image" width="60"/>--}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" id="order_id" value="{{ $order->id }}">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>No record found.</p>
        @endif
    </div>

@endsection

@section('JS')
    <script>
        new DataTable('#example');

        $('#order_status').on('change', function (){
           var status = $(this). val();
           var id = $('#order_id').val();
           var url = '{{ route('order-status-update') }}'

           $.ajax({
              url: url,
              type: 'GET',
              dataType: 'JSON',
              data: {status:status, id:id},
              success: function (response){
                  // console.log(response);
                  location.reload();
              }
           });
        });
    </script>
@endsection
