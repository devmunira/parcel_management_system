<!DOCTYPE html>
<html>

<head>
    <style type="text/css" media="print">
        @page {
            size: Portrait;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }

        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }
        </style>

</head>

<body>
    <div id="print_div">
        @foreach ($orders as $order )
        <div class="card" id="print_div" style="width: 95%;
    background-color: white;
    margin: 50px auto;
    height: auto;
    border: 1px solid #444;
    padding: 10px;
    text-align: center;">
        <div class="card-header">
            <h1 style="text-align: center; margin:0px; font-size:24px;">DEMAND ZONE</h1>
            <h6 style="text-align: center; font-size: 18px; margin: 10px 0px;">76/E Lotus Society</h6>
            <h6 style="text-align: center; font-size: 18px; margin: 10px 0px;">Meradia Banasree, Rampura</h6>
            <p style="text-align: center; font-size: 16px;">Owner: 01611-085085 . Any queries: 01911-045045 / 01777-462777</p>
            <p style="text-align: center; font-size: 16px;">Delivery Issue: 01868-612341</p>
            <hr>

            <div class="info" style=" display: flex; flex-direction: row; justify-content: space-between; text-align: left; padding: 20px 0px;">
                <div class="cutomer_info">
                    <ul style="padding:0px !important;">
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px; font-weight:bold; margin-bottom:5px;"><span style="font-weight:normal;">Customer Name:&nbsp;</span>{{ $order -> name }}</li>
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px; font-weight:bold; margin-bottom:5px;"><span style="font-weight:normal;">Phone Number:&nbsp;</span>{{ $order -> phone  }} {{@$order -> ad_phone ? ' /' : ''}}  {{ @$order -> ad_phone   }}
                        </li>
                        <li style="list-style-type: none; font-size:16px;  border: 1px solid #444; padding: 10px 20px; font-weight:bold; margin-bottom:5px;"><span style="font-weight:normal;">Address:&nbsp;</span>{{ $order -> address }}</li>
                    </ul>
                </div>
                <div class="invoice_info">
                    <ul>
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px; font-weight:bold; margin-bottom:5px;"><span style="font-weight:normal;">Invoice Date:&nbsp;</span>{{ date('d/m/Y', strtotime(@$order -> created_at)) }}</li>



                    </ul>
                </div>
            </div>

        </div>
        <hr>
        <div class="card-body">
            <div class="table-wrapper">
                <table class="fl-table" style="border-radius: 5px; font-size: 12px;
                font-weight: normal;
                border: none;
                border-collapse: collapse;
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
                background-color: white;">
                    <thead>
                    <tr>
                        <th style="text-align: center;
    padding: 8px;" color: #ffffff;
    background: #324960;>Product Description</th>
                        <th style="text-align: center;
    padding: 8px;" color: #ffffff;
    background: #324960;>Product Qnty</th>
                        <th style="text-align: center;
    padding: 8px;" color: #ffffff;
    background: #324960;>Calculation</th>
                        <th style="text-align: center;
    padding: 8px;" color: #ffffff;
    background: #324960;>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> product }}</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> quantity }}</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">Product Price</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> price }} TK</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">Discount (-): </td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> discount }} %</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">Shipping Charge (+): </td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> shipping_charge  }} TK</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">---</td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">Total: </td>
                        <td style="text-align: center;
    padding: 8px; border-right: 1px solid #f8f8f8;
    font-size: 12px; background: #F8F8F8;">{{ @$order -> total  }} TK</td>
                    </tr>


                    <tbody>
                </table>
            </div>

        </div>

        <hr>
            <div class="code">
                <div class="barcode">
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG(@$order -> order_number, 'C39+') }}" alt="barcode"   />

                    <p><b>Invoice Number: </b> {{ @$order -> order_number  }}</p>
                </div>
            </div>
            <hr>
            <div class="info" style=" display: flex; flex-direction: row; justify-content: space-between; text-align: left; padding: 20px 0px;">
                <div class="cutomer_info">
                    <ul style="padding:0px !important;">
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px;  margin-bottom:5px;"><span>Delivery Method:&nbsp;</span>{{ @$order -> deliverymethod -> name }}</li>
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px;  margin-bottom:5px;"><span>Charge Type:&nbsp;</span>
                            @php
                               $arr =  array_diff($order -> delivery_method_type , ['Free']);
                            @endphp
                            {{end($arr)}}

                        </li>
                    </ul>
                </div>
                <div class="invoice_info">
                    <ul>
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px;  margin-bottom:5px;"><span>Delivery Area:&nbsp;</span>{{ $order -> area['0'] }}</li>
                        <li style="list-style-type: none; font-size:16px; border: 1px solid #444; padding: 10px 20px;  margin-bottom:5px;"><span>Shipping Charge:&nbsp;</span>{{ $order -> shipping_charge ? @$order ->shipping_charge : 'Free' }}</li>

                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-left" style="text-align: left;">
                <p class="text-left">{!!'Comments:' . @$order -> comments !!}</p>
            </div>
    </div>
            <br>
            <br>
            <br>
        @endforeach

    </div>
    <script>
        var prtContent = document.getElementById("print_div");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        var curURL = window.location.href;
        history.replaceState(history.state, '', '/');
        window.print();
        history.replaceState(history.state, '', curURL);
        WinPrint.close();

    </script>
</body>

</html>
