<!doctype html>
<html lang="en">
<head>
    <title>Invoice</title>
</head>
<body>
    <div style="background-color: #0c84ff; color: white; text-align: center; padding-top: 5px; padding-bottom: 5px">
        <h2>Order Invoice</h2>
    </div>

    <div style="margin-top: 15px;">
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%">
            <tr style="border-collapse: collapse; border: 1px solid black; background-color: lightgrey">
                <th colspan="5" style="text-align: center; padding-top: 20px; padding-bottom: 20px">Design</th>
            </tr>

            <tr>
                <th style="border: 1px solid black; padding: 5px">Customer Name </th>
                <th style="border: 1px solid black">Design Name</th>
                <th style="border: 1px solid black">Fabric</th>
                <th style="border: 1px solid black">Placement</th>
                <th style="border: 1px solid black">Format</th>
            </tr>

            <tr style="border: 1px solid black">
                <td style="text-align: center; border: 1px solid black; padding: 3px">{{ ucwords($invoiceData->customer->name) ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ ucwords($invoiceData->design_name) ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->fabric ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->placement ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">
                    @php
                        $formats = json_decode($invoiceData->format);
                    @endphp

                    @forelse($formats as $format)
                        <span style="font-size: 8px">{{ $format }}</span>
                        @if(!$loop->last)
                            <span style="font-size: 8px">,</span>
                        @endif
                    @empty
                    @endforelse
                </td>
            </tr>

            <tr style="border-collapse: collapse">
                <th colspan="5" style="text-align: center; border: 1px solid black; padding-top: 20px; padding-bottom: 20px; background-color: lightgrey">More Details</th>
            </tr>

            <tr>
                <th style="border: 1px solid black; padding: 5px">No. of Colors</th>
                <th style="border: 1px solid black">Height</th>
                <th style="border: 1px solid black">Width</th>
                <th style="border: 1px solid black">Colors Type</th>
                <th style="border: 1px solid black">Patch Type</th>
            </tr>

            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 3px">{{ $invoiceData->no_color ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->height ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->width ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->color_type ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->patch_type ?? '--' }}</td>
            </tr>

            <tr style="border-collapse: collapse">
                <th colspan="5" style="text-align: center; border: 1px solid black; padding-top: 20px; padding-bottom: 20px; background-color: lightgrey">Order</th>
            </tr>

            <tr>
                <th style="border: 1px solid black; padding: 5px">Order Type</th>
                <th style="border: 1px solid black">Order Status</th>
                <th style="border: 1px solid black">Urgent</th>
                <th style="border: 1px solid black">Price</th>
                <th style="border: 1px solid black">Shipping Cost</th>
            </tr>

            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 3px">{{ ucfirst($invoiceData->order_type) . " Order" ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">
                    @if($invoiceData->order_status == '0')
                        Pending
                    @elseif($invoiceData->order_status == '1')
                        Approved
                    @else
                        Cancel
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->urgent ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->price ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black">{{ $invoiceData->shipping_cost ?? '--' }}</td>
            </tr>

            <tr>
                <th style="border: 1px solid black; padding: 5px" colspan="2">Tracking ID</th>
                <th style="border: 1px solid black" colspan="3"></th>
            </tr>

            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 3px" colspan="2">{{ $invoiceData->tracking_id ?? '--' }}</td>
                <td style="text-align: center; border: 1px solid black" colspan="3"></td>
            </tr>

{{--            <tr style="border-collapse: collapse">--}}
{{--                <th colspan="5" style="text-align: center; border: 1px solid black; padding-top: 20px; padding-bottom: 20px; background-color: lightgrey">Image</th>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td style="text-align: center; border: 1px solid black; padding: 10px" colspan="5">--}}
{{--                    @php--}}
{{--                        $img = $invoiceData->image ?? 'No-Image.png';--}}
{{--                    @endphp--}}

{{--                    <img src="{{ public_path('images'. "/". $img) }}" alt="No Image" width="150" />--}}
{{--                </td>--}}
{{--            </tr>--}}
        </table>
    </div>
</body>
</html>
