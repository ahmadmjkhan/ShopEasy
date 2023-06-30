<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table style="width:700px;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><img src="" alt=""></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hello {{$name}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Your Order #{{$order_id}} Item status has been updated to ({{$order_status}})</td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
        @if(!empty($courier_name) && !empty($tracking_number))
        <tr>
            <td>Courier Name is {{$courier_name}} and Tracking Number is {{$tracking_number}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        @endif

        <tr>
            <td>Your Order Item Details Are Below:</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table style="width: 95%;" cellpadding="5" cellspacing="5">
                    <tr>
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td>Product Size</td>
                        <td>Product Color</td>
                        <td>Product Quantity</td>
                        <td>Product Price</td>
                    </tr>
                    @foreach($orderDetails['order_products'] as $order)
                    <tr>
                        <td>{{$order['product_name']}}</td>
                        <td>{{$order['product_code']}}</td>
                        <td>{{$order['product_size']}}</td>
                        <td>{{$order['product_color']}}</td>
                        <td>{{$order['product_quantity']}}</td>
                        <td>Rs:{{$order['product_price']}}</td>
                    </tr>
                    @endforeach
                    
                </table>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><strong>Delivery Address:</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['name']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['address']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['city']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['state']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['country']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['pincode']}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>{{$orderDetails['phone']}}</strong></td>
                    </tr>


                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>For Any Queries,You can Contact us At <a href="mailto:ahmedmjkhan977@gmail.com">ahmedmjkhan977@gmail.com</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Regards,<br>ShopEasy</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        </td>
        </tr>

    </table>
</body>

</html>