@php

    $order =  App\Models\Order::where('id' , $id)->with('Deliverymen' , 'deliverymethod')->first();
        $method = $order -> deliverymethod -> name;
        $man = $order -> Deliverymen -> name;
        $man = $order -> Deliverymen -> name;
        $number = $order -> Deliverymen -> phone;

        $order = [
            'name' => $order -> name,
            'phone' => $order -> phone,
            'ad_phone' => $order -> ad_phone,
            'address' => $order -> address,
            'status' => $order -> status,
            'method' => $method,
            'man' => $man,
            'comments' => $order -> comments,
            'quantity' => $order -> qnty,
            'price' => $order -> price,
            'discount' => $order -> discount,
            'shipping_charge' => $order -> shipping_charge,
            'total' => $order -> total,
            'delivery_method_type' => $order -> delivery_method_type,
            'order_number' => $order -> order_number,
            'product' => $order -> product,
            'id' => $order -> id,
            'created_at' => $order -> created_at,
            'number' => $number,

        ];
@endphp


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Electrolize&family=Orbitron:wght@600&display=swap" rel="stylesheet">
<style>
    @media print{


    h1{
        margin-bottom: 0px;
        padding-bottom: 5px;
        font-family: 'Orbitron', sans-serif;
        }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Electrolize', sans-serif;
                color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    ul{
        margin: 0px;
        padding: 0px;
    }

    ul, li , ol {
        list-style-type: none;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    .barcode{
        width: 100px;
        float: right;
    }
}
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table class="invoice">
                        <tr>
                            <td class="">
                                <h1>DEMAND ZONE</h1>
                                <span>Rampura Branch</span><br>
                                <span>01611-085-085 / 01777-462-777</span>
                            </td>

                            <td>

                               <div class="barcode">
                                {{-- <img src="data:image/png;base64,<?php  DNS1D::getBarcodePNG('4', 'C39+',3,33,array(1,1,1), true) ?>" alt="barcode"   /> --}}
                               {{-- {{ DNS2D::getBarcodeHTML(asset('/order_invoice/'. $order['order_number'] .'/'. $order['id'] ), 'QRCODE' , 3.5 , 3.5) }} --}}
                                <br>
                               </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <ul>

                                            <li><span>Customer Name
                                                &nbsp;&nbsp;:</span>{{ $order['name'] }}</li>
                                    <li><span>Customer Phone &nbsp;:</span>{{ $order['phone'] }}
                                    </li>
                                    <li><span>Customer Address:</span>{{ $order['address'] }}</li>
                                </ul>
                            </td>

                            <td>
                                <ul>
                                    <li><span>Invoice #:
                                        &nbsp;&nbsp;:</span>{{ $order['order_number'] }}</li>
                                        @if ($order['method'] === 'Personal Delivery Man')
                                        <li><span>Delivery Man Number:</span>{{ $order['number']  }}</li>
                                        <li><span>Delivery Man:</span>{{ $order['man']  }}</li>
                                        @else
                                        <li><span>Delivery Method:</span>{{ $order['method']  }}</li>
                                        @endif
                                    <li><span>Payment Type:</span>{{ $order['delivery_method_type']  }}</li>


                                </ul>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Price
                </td>
            </tr>

            <tr class="item">
                <td>
                    {{ $order['product'] }}
                </td>

                <td>
                    {{ $order['price'] }}
                </td>
            </tr>

            <tr class="item">
                <td>
                    Discount
                </td>

                <td>
                    {{ $order['discount'] }} %
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Shipping Charge
                </td>

                <td>
                    {{ $order['shipping_charge'] }}
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                   Total:  {{ $order['total'] }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
