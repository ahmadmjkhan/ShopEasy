<div class="table-content table-responsive ">
    <table class="table">
        <thead>
            <tr>
                <th class="li-product-remove">remove</th>
                <th class="li-product-thumbnail">images</th>
                <th class="cart-product-name">Product</th>
                <th class="li-product-price">Unit Price</th>
                <th class="li-product-stock-status">Stock Status</th>
                <th class="li-product-add-cart">add to cart</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($userWishlistItems as $wishlist)
            <tr>
                <td class="li-product-remove " ><i class="fa fa-times wishlistItemDelete" data-wishlistid="{{$wishlist['id']}}"></i></td>
                <td class="li-product-thumbnail"><a href="#"><img src="{{asset('uploads/catalogue-images/products/small/'.$wishlist['products']['product_image'])}}" width="100" alt=""></a></td>
                <td class="li-product-name"><a href="{{route('product_details',$wishlist['products']['id'])}}">{{$wishlist['products']['product_name']}}</a></td>
                <td class="li-product-price"><span class="amount">Rs {{$wishlist['products']['product_price']}}</span></td>
                <td class="li-product-stock-status"><span class="in-stock">in stock</span></td>
                <td class="li-product-add-cart"><a href="#">add to cart</a></td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>