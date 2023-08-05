<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>


    @font-face {
    font-family: myFirstFont;
    src: url('Orbitron Black.ttf');
    }


    h1{
        margin-bottom: 0px;
        padding-bottom: 5px;
        font-family: myFirstFont;
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: myFirstFont;
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
                                @php
                                echo DNS2D::getBarcodeHTML(asset('/order_invoice/'. @$order_number .'/'. @$id ), 'QRCODE' , 3.5 , 3.5);
                                @endphp
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
                                                &nbsp;&nbsp;:</span>{{ @$name }}</li>
                                    <li><span>Customer Phone &nbsp;:</span>{{ @$phone }} {{ @$ad_phone && @$ad_phone }}
                                    </li>
                                    <li><span>Customer Address:</span>{{ @$address }}</li>
                                </ul>
                            </td>

                            <td>
                                <ul>
                                    <li><span>Invoice #:
                                        &nbsp;&nbsp;:</span>{{ $order_number }}</li>
                                        {{-- @if ($method === 'Personal Delivery Man') --}}
                                        <li><span>Delivery Man Number:</span>{{ @$number  }}</li>
                                        <li><span>Delivery Man:</span>{{ @$man  }}</li>
                                        {{-- @else --}}
                                        <li><span>Delivery Method:</span>{{ $method  }}</li>
                                        {{-- @endif --}}
                                    <li><span>Payment Type:</span>{{ $delivery_method_type[0]  }}</li>



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
                    {{ @$product }}
                </td>

                <td>
                    {{ @$price }}
                </td>
            </tr>

            <tr class="item">
                <td>
                    Discount
                </td>

                <td>
                    {{ @$discount }} %
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Shipping Charge
                </td>

                <td>
                    {{ @$shipping_charge }}
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                   Total:  {{ @$total }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
