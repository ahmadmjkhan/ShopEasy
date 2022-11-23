$(document).ready(function() {

    loadcart();

    function loadcart() {

        $.ajax({
            method: "GET",
            url: "load-cart-data",

            success: function(response) {
                console.log(response.count);
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    $(document).on('submit', '.form_operation', function(e) {

        e.preventDefault();


        var url = $(this).attr('action');
        var data = new FormData($('.form_operation')[0]);



        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            contentType: false,
            processData: false,
            data: data,
            dataType: 'json',
            beforeSend: function() {

                $(document).find('span.error-text').text('');
            },

            success: function(response) {
                loadcart();
                if (response.status == '0') {

                    // $('.form_operation')[0].reset();


                    Swal.fire(
                        response.message,

                    )

                    // window.location=response.redirect_url; // for redirect location//

                } else {
                    Swal.fire(
                        response.message,

                    )
                }
            }
        });
    });


    $("#sort").on('change', function() {


        var sort = $("#sort").val();
        var url = $("#url").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',

            data: { url: url, sort: sort },
            success: function(data) {

                $('.filter-products').html(data);

            },
            error: function() {
                alert('error');
            }
        });



    });


    // used for change in size to get attribute price //
    $("#getPrice").on('change', function() {
        // alert("hello");
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-attribute-price',
            method: 'post',

            data: { size: size, product_id: product_id },
            success: function(data) {

                // alert(data['final_price']);
                // alert(data['discount']);
                if (data['discount'] > 0) {

                    $(".getAttributedPrice").html("<div class='price-box'><span class='new-price new-price-2'>Rs: " + data['final_price'] + " </span><span class='old-price'><s>" + data['product_price'] + " </s></span><span class='discount-percentage'>-7%</span></div>");
                } else {
                    $('.getAttributedPrice').html("<div class='price-box'><span class='old-price'>Rs:" + data['final_price'] + " </span></div>");
                }

            },
            error: function() {
                alert('error');
            }
        });

    });


    // $(".quick-product-view").on('click', function() {

    //     product_id = $(this).attr('product_id');

    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         method: 'post',
    //         url: '/quick-view',
    //         data: { product_id: product_id },
    //         success: function(data) {



    //             $('.quick-view-modal').html();
    //             $('#quick_modal').modal('show');



    //         },
    //         error: function() {
    //             alert('error');
    //         }
    //     });
    // })



    // $('.AddTocartbtn').on('', function(e) {
    //     e.preventDefault();

    //     alert('click');

    //     var prod_id = $(this).closest('.product-data').find('.prod_id').val();
    //     var prod_qty = $(this).closest('.product-data').find('.qty_input').val();

    //     // alert('id is' + prod_id);
    //     // alert('qty is' + prod_qty);




    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         method: "POST",
    //         url: "add-to-cart",
    //         data: {
    //             'prod_id': prod_id,
    //             'prod_qty': prod_qty,
    //         },

    //         success: function(response) {

    //             Swal.fire(
    //                 'Item Added To cart!',
    //                 'Your Status Is Now Active',
    //                 'success'
    //             )
    //             loadcart();
    //         },

    //     });
    // });







    $(document).on('click', '.increament_btn', function(e) {
        e.preventDefault();


        var inc_value = $(this).closest('.product-data').find('.qty_input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 100) {
            value++;
            $(this).closest('.product-data').find('.qty_input').val(value);
        }
    });


    $(document).on('click', '.decreament_btn', function(e) {
        e.preventDefault();

        var dec_value = $(this).closest('.product-data').find('.qty_input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest('.product-data').find('.qty_input').val(value);
        }
    });





    // var quantitiy = 0;
    // $('.quantity-right-plus').click(function(e) {

    //     // Stop acting like a button
    //     e.preventDefault();
    //     // Get the field name
    //     var quantity = parseInt($('#quantity').val());

    //     // If is not undefined

    //     $('#quantity').val(quantity + 1);


    //     // Increment

    // });

    // $('.quantity-left-minus').click(function(e) {
    //     // Stop acting like a button
    //     e.preventDefault();
    //     // Get the field name
    //     var quantity = parseInt($('#quantity').val());

    //     // If is not undefined

    //     // Increment
    //     if (quantity > 0) {
    //         $('#quantity').val(quantity - 1);
    //     }
    // });


    $(document).on("click", ".changeQuantity", function() {


        if ($(this).hasClass('decreament_btn')) {

            var quantity = $(this).data('qty');


            if (quantity <= 1) {
                alert("Item Quantity must be 1 or Greater");
                return false;
            }

            new_qty = parseInt(quantity) - 1;



        }

        if ($(this).hasClass('increament_btn')) {

            var quantity = $(this).data('qty');


            new_qty = parseInt(quantity) + 1;



        }
        var cartid = $(this).data('id');


        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: { cartid: cartid, qty: new_qty },
            url: 'cart-update',
            type: 'post',
            success: function(response) {
                if (response.status == false) {
                    Swal.fire(
                        response.message,

                    )
                }
                $('#appendCartItems').html(response.view);
            },
            error: function() {
                alert('error');
            }
        });
    });

    // $(document).on('click', '.updateCartItem', function(e) {

    //     alert('hello');
    //     if ($(this).hasClass('quantity-left-minus')) {

    //         var quantity = parseInt($('#quantity').val());

    //         // If is not undefined

    //         // Increment
    //         if (quantity > 0) {
    //             var new_qty = $('#quantity').val(quantity - 1);
    //             alert(new_qty);
    //         }





    //         alert(new_qty);
    //     }

    //     if ($(this).hasClass('quantity-right-plus')) {
    //         var quantity = parseInt($('#quantity').val());

    //         // If is not undefined

    //         var new_qty = $('#quantity').val(quantity + 1);

    //         alert(new_qty);
    //     }


    //     // var prod_id = $(this).closest('.product-data').find('.prod_id').val();
    //     // var qty = $(this).closest('.product-data').find('.qty_input').val();

    //     var cart_id = $(this).data('cartid');

    //     // var qty = $(this).data('qty');

    //     alert(cart_id);
    //     // alert(qty);
    //     data = {
    //             'cart_id': cart_id,
    //             'prod_qty': new_qty
    //         },

    //         // alert(prod_id);
    //         // alert(qty);



    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             method: 'post',
    //             url: "cart-update",
    //             data: data,
    //             success: function(response) {
    //                 alert(response);

    //                 if (response.status == '1') {
    //                     $('.appendcartitems').html(response.view);
    //                     // $('.cartitem-reload').load(location.href + " .cartitem-reload");
    //                 }
    //                 // window.location.reload();


    //             }
    //         });



    // })

    // $(document).on('click', '.changeQuantity', function(e) {
    //     // alert('hello');
    //     e.preventDefault();

    //     var prod_id = $(this).closest('.product-data').find('.prod_id').val();
    //     var qty = $(this).closest('.product-data').find('.qty_input').val();

    //     // alert(prod_id);
    //     // alert(qty);
    //     data = {
    //             'prod_id': prod_id,
    //             'prod_qty': qty
    //         },

    //         // alert(prod_id);
    //         // alert(qty);

    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });

    //     $.ajax({

    //         method: "post",
    //         url: "cart-update",
    //         data: data,
    //         success: function(response) {
    //             // window.location.reload();
    //             $('.cartitem-reload').load(location.href + " .cartitem-reload");

    //         }
    //     });



    // });

    // $(document).on('click', '.changeQuantity', function(e) {
    //     alert('hello');
    //     e.preventDefault();

    //     var cart_id = $(this).data('cartId');
    //     var qty = $(this).data('qty');

    //     alert(cart_id);
    //     alert(qty);
    //     data = {
    //             'prod_id': prod_id,
    //             'prod_qty': qty
    //         },

    //         // alert(prod_id);
    //         // alert(qty);

    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });

    //     $.ajax({

    //         method: "post",
    //         url: "cart-update",
    //         data: data,
    //         success: function(response) {
    //             // window.location.reload();
    //             $('.cartitem-reload').load(location.href + " .cartitem-reload");

    //         }
    //     });



    // });


    $(document).on('click', '.delete-cart-item', function(e) {

        e.preventDefault();
        var prod_id = $(this).closest('.product-data').find('.prod_id').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: "post",
                    url: "delete-cart-item",
                    data: {
                        'prod_id': prod_id,
                    },

                    success: function(response) {


                        if (response.status == '1') {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                            loadcart();
                            $('.cartitem-reload').load(location.href + " .cartitem-reload"); //reload only specific card not whole page //
                        }

                    }
                });

            } else if (result.dismiss) {
                Swal.fire(
                    'Cancelled!',
                    'Your file has been Safe.',
                    'error'
                )
            }

        });

    });

})