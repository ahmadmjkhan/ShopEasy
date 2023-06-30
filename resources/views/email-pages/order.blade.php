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
            <td>Thanks for Shopping with Us, Your Order Details are as below:</td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Order No. {{$order_id}}</td>
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
                        <td>{{$order['product_price']}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">Shipping Charges</td>
                        <td>INR {{$orderDetails['shipping_charges']}}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Coupon Discount</td>
                        <td>INR @if($orderDetails['coupon_amount']>0)
                            {{$orderDetails['coupon_amount']}}
                            @else
                            0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">Grand Total</td>
                        <td>INR {{$orderDetails['grand_total']}}</td>
                    </tr>
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