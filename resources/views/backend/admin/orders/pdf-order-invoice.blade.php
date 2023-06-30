<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="{{asset('admin/custom.css')}}" media="all" />
</head>

<style>
    @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087c3;
        text-decoration: none;
    }

    .invoice-body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #555555;
        background: #ffffff;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #aaaaaa;
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
    }

    #details {
        margin-bottom: 50px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #0087c3;
        float: left;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        float: right;
        text-align: right;
    }

    #invoice h1 {
        color: #0087c3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table th,
    table td {
        padding: 20px;
        background: #eeeeee;
        text-align: center;
        border-bottom: 1px solid #ffffff;
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
    }

    table td {
        text-align: right;
    }

    table td h3 {
        color: #57b223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #ffffff;
        font-size: 1.6em;
        background: #57b223;
    }

    table .desc {
        text-align: left;
    }

    table .unit {
        background: #dddddd;
    }

    

    table .total {
        background: #57b223;
        color: #ffffff;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table tbody tr:last-child td {
        border: none;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #ffffff;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #aaaaaa;
    }

    table tfoot tr:first-child td {
        border-top: none;
    }

    table tfoot tr:last-child td {
        color: #57b223;
        font-size: 1.4em;
        border-top: 1px solid #57b223;
    }

    table tfoot tr td:first-child {
        border: none;
    }

    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices {
        padding-left: 6px;
        border-left: 6px solid #0087c3;
    }

    #notices .notice {
        font-size: 1.2em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #aaaaaa;
        padding: 8px 0;
        text-align: center;
    }
</style>

<body class="invoice-body">
    <header class="clearfix">
        <div id="logo">
            <img src="{{asset('uploads/shopeasy-logo6.png')}}">
        </div>
        <div id="company">
            <h2 class="name">Shipped To</h2>
            <div>
                {{$orderDetails['address']}},{{$orderDetails['city']}},

                {{$orderDetails['state']}},

                {{$orderDetails['pincode']}}<br>
                Phone:{{$orderDetails['phone']}}<br>
                Email: {{$orderDetails['email']}}
                <br>
            </div>

        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">BILLED TO:</div>
                <h2 class="name">{{$userDetails['name']}}</h2>

                <div class="address">
                    @if(!empty($userDetails['address']))
                    {{$userDetails['address']}},
                    @endif
                    @if(!empty($userDetails['city']))
                    {{$userDetails['city']}},
                    @endif
                    @if(!empty($userDetails['state']))
                    {{$userDetails['state']}},
                    @endif
                    @if(!empty($userDetails['pincode']))
                    {{$userDetails['pincode']}}<br>
                    @endif
                    @if(!empty($userDetails['phone']))
                    Phone:{{$userDetails['phone']}}<br>
                    @endif
                </div>

                <div class="email"><a href="#">
                        @if(!empty($userDetails['email']))
                        Email: {{$userDetails['email']}}<br>
                        @endif

                    </a>
                </div>
            </div>
            <div id="invoice">
                <h1>@php echo DNS1D::getBarcodeHTML($orderDetails['id'],'C39') @endphp</h1>
                <div class="date">Date of Invoice: {{date('d-m-Y',strtotime($orderDetails['created_at']))}}</div>
                <div class="date">Due Date: 30/06/2014</div>
                <div class="date">Payment Mode:{{$orderDetails['payment_method']}}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc">Product</th>
                    <th class="unit">Product Code</th>
                    <th class="qty">Color</th>
                    <th class="qty">Quantity</th>
                    <th class="unit">Price</th>
                    <th class="total">SubTotal</th>
                </tr>
            </thead>
            <tbody>

                @php $subtotal = 0; @endphp
                @foreach($orderDetails['order_products'] as $product)
                <tr>
                    <td class="no">1</td>
                    <td class="desc">{{$product['product_name']}}</td>
                    <td class="desc">{{$product['product_code']}}@php echo DNS1D::getBarcodeHTML($product['product_code'],'C39') @endphp</td>
                    <td class="qty">{{$product['product_color']}}</td>
                    <td class="qty">{{$product['product_quantity']}}</td>
                    <td class="unit">Rs {{$product['product_price']}}</td>
                    <td class="total">INR {{$product['product_quantity']*$product['product_price']}}</td>
                </tr>
                @php $subtotal = $subtotal+($product['product_price']*$product['product_quantity']) @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">SUBTOTAL</td>
                    <td>{{$subtotal}}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">TAX 25%</td>
                    <td>$1,300.00</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3">GRAND TOTAL</td>
                    <td>Rs {{$orderDetails['grand_total']}}<br>
                        @if($orderDetails['payment_method'] == 'COD')
                        <span style="color:red;">Already Paid</span>
                        @endif
                    </td>

                </tr>
            </tfoot>
        </table>
        <div id="thanks">Thank you!<br>For Shopping</div>

    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>