$(document).ready(function () {
    $(document).on("submit", ".user_register_form_operation", function (e) {
        e.preventDefault();

        $(".register-button").text("Please Wait ...");

        let url = $(this).attr("action");

        let data = new FormData($(".user_register_form_operation")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else if (response.status == "2") {
                    // for invalid username and password show //

                    $(".error_message").show();
                    $(".error_message").html(response.message);

                    setTimeout(function () {
                        $(".error_message").fadeOut("slow");
                    }, 3000);
                } else {
                    $(".user_register_form_operation")[0].reset();

                    $(".success_message").show();
                    $(".success_message").html(response.message);
                    $(".register-button").css("background", "cyan");
                    $(".register-button").text("Registered");

                   
                }
            },
        });
    });

    $(document).on("submit", ".user_login_form_operation", function (e) {
        e.preventDefault();

        let url = $(this).attr("action");

        let data = new FormData($(".user_login_form_operation")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else if (response.status == "2") {
                    // for invalid username and password show //
                    $(".error_message").show();
                    $(".error_message").html(response.message);

                    setTimeout(function () {
                        $(".error_message").fadeOut("slow");
                    }, 3000);
                } else if (response.status == "inactive") {
                    $(".error_message").show();
                    $(".error_message").html(response.message);
                } else {
                    $(".user_login_form_operation")[0].reset();

                    $(".success_message").show();
                    $(".success_message").html(response.message);

                    // $(function() {
                    //     var Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 3000
                    //     });

                    //     Toast.fire({
                    //         icon: 'success',
                    //         title: response.message,
                    //     });

                    // });
                    // window.location=response.redirect_url; // for redirect location//
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".forgot-password-form", function (e) {
        e.preventDefault();

        let url = $(this).attr("action");

        let data = new FormData($(".forgot-password-form")[0]);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    $(".forgot-password-form")[0].reset();

                    $(".success_message").show();
                    $(".success_message").html(response.message);

                    // $(function() {
                    //     var Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 3000
                    //     });

                    //     Toast.fire({
                    //         icon: 'success',
                    //         title: response.message,
                    //     });

                    // });
                    // window.location=response.redirect_url; // for redirect location//
                    // setTimeout(function() {
                    //     window.location = response.redirect_url;
                    // }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".myaccount_form_operation", function (e) {
        alert("hello");
        e.preventDefault();

        let url = $(this).attr("action");
        alert(url);

        let data = new FormData($(".myaccount_form_operation")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });

                    // } else if (response.status == '2') {
                    //     // for invalid username and password show //
                    //     $('.error_message').show();
                    //     $('.error_message').html(response.message);

                    //     setTimeout(function() {
                    //         $('.error_message').fadeOut('slow');
                    //     }, 3000);
                } else {
                    $(".myaccount_form_operation")[0].reset();

                    $(".success_message").show();
                    $(".success_message").html(response.message);

                    // $(function() {
                    //     var Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 3000
                    //     });

                    //     Toast.fire({
                    //         icon: 'success',
                    //         title: response.message,
                    //     });

                    // });
                    // window.location=response.redirect_url; // for redirect location//
                    // setTimeout(function() {
                    //     window.location = response.redirect_url;
                    // }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".upadatepassword_form_operation", function (e) {
        e.preventDefault();

        let url = $(this).attr("action");

        let data = new FormData($(".upadatepassword_form_operation")[0]);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else if (response.type == "incorrect") {
                    // for invalid username and password show //
                    $(".password_error_message").show();
                    $(".password_error_message").html(response.message);

                    setTimeout(function () {
                        $(".password_error_message").fadeOut("slow");
                    }, 3000);
                } else {
                    $(".upadatepassword_form_operation")[0].reset();

                    $(".password_success_message").show();
                    $(".password_success_message").html(response.message);

                    setTimeout(function () {
                        $(".password_success_message").fadeOut("slow");
                    }, 3000);

                    // $(function() {
                    //     var Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 3000
                    //     });

                    //     Toast.fire({
                    //         icon: 'success',
                    //         title: response.message,
                    //     });

                    // });
                    // window.location=response.redirect_url; // for redirect location//
                    // setTimeout(function() {
                    //     window.location = response.redirect_url;
                    // }, 2000);
                }
            },
        });
    });

    // loadcart();

    // function loadcart() {

    //     $.ajax({
    //         method: "GET",
    //         url: "load-cart-data",

    //         success: function(response) {
    //             console.log(response.count);
    //             $('.cart-count').html('');
    //             $('.cart-count').html(response.count);
    //         }
    //     });
    // }

    $(document).on("submit", ".form_operation", function (e) {
        // alert('hello');
        e.preventDefault();

        var url = $(this).attr("action");
        var data = new FormData($(".form_operation")[0]);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            method: "POST",
            contentType: false,
            processData: false,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (response) {
                $(".totalcartitems").html(response.totalCartItem);
                if (response.status == "0") {
                    // $('.form_operation')[0].reset();

                    Swal.fire(response.message);

                    // window.location=response.redirect_url; // for redirect location//
                } else {
                    Swal.fire(response.message);
                }
            },
        });
    });

    // used for change in size to get attribute price //
    $("#getPrice").on("change", function () {
        // alert("hello");
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get-attribute-price",
            method: "post",

            data: { size: size, product_id: product_id },
            success: function (data) {
                // alert(data['final_price']);
                // alert(data['discount']);
                if (data["discount"] > 0) {
                    $(".getAttributedPrice").html(
                        "<div class='price-box'><span class='new-price new-price-2'>Rs: " +
                            data["final_price"] +
                            " </span><span class='old-price'><s>" +
                            data["product_price"] +
                            " </s></span><span class='discount-percentage'>-7%</span></div>"
                    );
                } else {
                    $(".getAttributedPrice").html(
                        "<div class='price-box'><span class='old-price'>Rs:" +
                            data["final_price"] +
                            " </span></div>"
                    );
                }
            },
            error: function () {
                alert("error");
            },
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

    $(document).on("click", ".increament_btn", function (e) {
        e.preventDefault();

        var inc_value = $(this)
            .closest(".product-data")
            .find(".qty_input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 100) {
            value++;
            $(this).closest(".product-data").find(".qty_input").val(value);
        }
    });

    $(document).on("click", ".decreament_btn", function (e) {
        e.preventDefault();

        var dec_value = $(this)
            .closest(".product-data")
            .find(".qty_input")
            .val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest(".product-data").find(".qty_input").val(value);
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

    $(document).on("click", ".changeQuantity", function () {
        if ($(this).hasClass("decreament_btn")) {
            var quantity = $(this).data("qty");

            if (quantity <= 1) {
                alert("Item Quantity must be 1 or Greater");
                return false;
            }

            new_qty = parseInt(quantity) - 1;
        }

        if ($(this).hasClass("increament_btn")) {
            var quantity = $(this).data("qty");

            new_qty = parseInt(quantity) + 1;
        }
        var cartid = $(this).data("id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            data: { cartid: cartid, qty: new_qty },
            url: "cart-update",
            type: "post",
            success: function (response) {
                $(".totalcartitems").html(response.totalCartItem);
                if (response.status == false) {
                    Swal.fire(response.message);
                }
                $("#appendCartItems").html(response.view);
                $("#append-mini-cart-items").html(response.minicartview);
            },
            error: function () {
                alert("error");
            },
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

    $(document).on("click", ".delete-cart-item", function (e) {
        e.preventDefault();
        var prod_id = $(this).closest(".product-data").find(".prod_id").val();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },

                    type: "post",
                    url: "delete-cart-item",
                    data: {
                        prod_id: prod_id,
                    },

                    success: function (response) {
                        if (response.status == "1") {
                            Swal.fire("Deleted!", response.message, "success");
                            $(".totalcartitems").html(response.totalCartItem);
                            $(".cartitem-reload").load(
                                location.href + " .cartitem-reload"
                            ); //reload only specific card not whole page //
                        }
                    },
                });
            } else if (result.dismiss) {
                Swal.fire("Cancelled!", "Your file has been Safe.", "error");
            }
        });
    });

    // Apply Coupon code //

    $("#ApplyCoupon").submit(function () {
        var user = $(this).attr("user");
        // alert(user);

        if (user == 1) {
        } else {
            alert("login first");
            return false;
        }

        var code = $("#code").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data: { code: code },
            url: "/user/apply-coupon",
            success: function (resp) {
                // alert(resp.couponAmount);
                // alert(resp.grand_total);
                if (resp.message != "") {
                    if (resp.status == true) {
                        $(".success_message").show();
                        $(".success_message").html(resp.message);
                        setTimeout(function () {
                            $(".success_message").fadeOut("slow");
                        }, 3000);
                    } else {
                        $(".error_message").show();
                        $(".error_message").html(resp.message);
                        setTimeout(function () {
                            $(".error_message").fadeOut("slow");
                        }, 3000);
                    }

                    // alert(resp.message);
                }

                if (resp.couponAmount > 0) {
                    // alert("yes");
                    $(".couponAmount").text("Rs." + resp.couponAmount);
                } else {
                    // alert("no");
                    $(".couponAmount").text("Rs. 0");
                }
                if (resp.grand_total > 0) {
                    // alert("yes grand");
                    $(".grand_total").text("Rs." + resp.grand_total);
                }
                $(".totalCartItems").html(resp.totalCartItem);

                $("#appendCartItems").html(response.view);
                $("#append-mini-cart-items").html(response.minicartview);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // Edit Deliver Address //
    $(document).on("click", ".editAddress", function () {
        var addressid = $(this).data("addressid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { addressid: addressid },
            url: "/user/get-delivery-address",
            type: "post",
            success: function (res) {
                // $('[name=delivery_id]').val(res.address['id']);
                $("#ship-box-info").css("display", "block");
                $(".newAddress").hide();
                $(".editAddresslabel").text("Edit Delivery Address");
                $("[name=delivery_id").val(res.address[0]["id"]);
                $("[name=delivery_name]").val(res.address[0]["name"]);
                $("[name=delivery_address]").val(res.address[0]["address"]);
                $("[name=delivery_city]").val(res.address[0]["city"]);
                $("[name=delivery_state]").val(res.address[0]["state"]);
                $("[name=delivery_country]").val(res.address[0]["country"]);
                $("[name=delivery_pincode]").val(res.address[0]["pincode"]);
                $("[name=delivery_phone]").val(res.address[0]["phone"]);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // update delivery Address form //
    $(document).on("submit", "#addressAddEditForm", function (e) {
        e.preventDefault();
        alert("helo");
        var formdata = $("#addressAddEditForm").serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/save-delivery-address",
            type: "post",
            data: formdata,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
            },

            success: function (resp) {
                if (resp.status == "0") {
                    $.each(resp.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    $("#deliveryAddresses").html(resp.view);
                    window.location.href = "checkout-page";
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });

    //Remove Delivery Addresses //
    $(document).on("click", ".removeAddress", function () {
        if (confirm("Are You Sure Want to Delete"));
        var addressid = $(this).data("addressid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/remove-delivery-address",
            type: "post",
            data: { addressid: addressid },

            success: function (resp) {
                $("#deliveryAddresses").html(resp.view);
                window.location.href = "checkout-page";
            },
            error: function () {
                alert("Error");
            },
        });
    });

    $("input[name=address_id]").bind("change", function () {
        var shipping_charges = $(this).attr("shipping_charges");

        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");

        $(".shipping_charges").html("₹" + shipping_charges);
        var codpincodeCount = $(this).attr("codpincodeCount");
        var prepaidpincodeCount = $(this).attr("prepaidpincodeCount");
        alert(codpincodeCount);

        if(codpincodeCount > 0) {
            $(".codMethod").show();
        }else{
            $(".codMethod").hide();
        }
        
        if(prepaidpincodeCount > 0) {
            $(".prepaidMethod").show();
        }else{
            $(".prepaidMethod").hide();
        }
        if (coupon_amount == "") {
            coupon_amount = 0;
        }
        $(".couponAmount").html("₹" + coupon_amount);
        var grand_total =
            parseInt(total_price) +
            parseInt(shipping_charges) -
            parseInt(coupon_amount);
        //    alert(grand_total);
        $(".grand_total").html("₹" + grand_total);


    });


    $("#checkpincode").click(function(){
        var pincode = $("#pincode").val();
        
        if(pincode==""){
            alert("Enter Pincode: ");
            return false;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data:{pincode:pincode},
            url:"/user/check-pincode",
            success: function(resp){
                // alert(resp.message);
                if(resp.status==1){
                    $(".success_message").show();
                    $(".success_message").html(resp.message);
                    setTimeout(function () {
                        $(".success_message").fadeOut("slow");
                    }, 3000);
                    
                }else{
                    $(".error_message").show();
                    $(".error_message").html(resp.message);
                    setTimeout(function () {
                        $(".error_message").fadeOut("slow");
                    }, 3000);
                }
            },error: function(){
                alert("Error");
            }
        })
    })

    $("#sort").on("change", function () {
        alert("hello");
        var sort = $("#sort").val();
        var url = $("#url").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "post",

            data: {
                url: url,
                sort: sort,
            },
            success: function (data) {
                $(".filter-products").html(data);
            },
            error: function () {
                alert("error");
            },
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $("." + class_name + ":checked").each(function () {
            filter.push($(this).val());
        });
        return filter;
    }
});
