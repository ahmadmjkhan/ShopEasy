<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr><td>Dear {{$userDetails['name']}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Your Return Request for Order no. {{$returnDetails['order_id']}} with E-commerce website is {{$return_status}}</td></tr>
        <tr><td>&nbsp;</td></tr>
       
        <tr><td>Thanks & regards.....</td></tr>
    </table>
</body>
</html>