$(document).ready(function () {
    $(".productSizes").hide();
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

    $(document).on("submit", ".form_operation", function (e) {
        alert("hello");
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

    // used for change in size to get attribute price in product details page //
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


     // -----------CARTS OPERATIONS----------------- //

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



     // -----------CARTS OPERATIONS END----------------- //




    // -----------CHECKOUT OPERATIONS----------------- //


    // Edit Delivery Address //
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
        var gst_charges = $(this).attr("gst_charges");
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");

        $(".shipping_charges").html("₹" + shipping_charges);
        $(".gst_charges").html("₹" + gst_charges);
        var codpincodeCount = $(this).attr("codpincodeCount");
        var prepaidpincodeCount = $(this).attr("prepaidpincodeCount");

        if (codpincodeCount > 0) {
            $(".codMethod").show();
        } else {
            $(".codMethod").hide();
        }

        if (prepaidpincodeCount > 0) {
            $(".prepaidMethod").show();
        } else {
            $(".prepaidMethod").hide();
        }
        if (coupon_amount == "") {
            coupon_amount = 0;
        }
        $(".couponAmount").html("₹" + coupon_amount);
        var grand_total =
            parseInt(total_price) +
            parseInt(gst_charges) +
            parseInt(shipping_charges) -
            parseInt(coupon_amount);
        //    alert(grand_total);
        $(".grand_total").html("₹" + grand_total);
    });

    $("#checkpincode").click(function () {
        var pincode = $("#pincode").val();

        if (pincode == "") {
            alert("Enter Pincode: ");
            return false;
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data: { pincode: pincode },
            url: "/user/check-pincode",
            success: function (resp) {
                // alert(resp.message);
                if (resp.status == 1) {
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
            },
            error: function () {
                alert("Error");
            },
        });
    });


    // -----------CHECKOUT OPERATIONS END----------------- //



    // -----------WISHLIST OPERATIONS----------------- //



    $(".updateWishlist").on("click", function () {
        var product_id = $(this).data("productid");
        //   alert(product_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "post",

            url: "/user/update-wishlist",
            data: { product_id: product_id },
            success: function (data) {
                if (data.action == "Added") {
                    $("a[data-productid=" + product_id + "]").html(
                        '<i class="fa fa-heart"></i>'
                    );
                    alert("Item added to Wishlist successfully");
                    
                    $(".totalWishlistItems").html(data.totalWishlistItems);
                } else if (data.action == "Remove") {
                    $("a[data-productid=" + product_id + "]").html(
                        '<i class="fa fa-heart-o"></i>'
                    );
                    alert("Item Reomve From Wishlist");
                   
                    $(".totalWishlistItems").html(data.totalWishlistItems);
                }
            },
            error: function () {
                alert("error");
            },
        });
    });

    $(document).on("click", ".wishlistItemDelete", function () {
        var wishlistid = $(this).data("wishlistid");

        alert("are you sure you want to delete");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "post",

            url: "delete-wishlist-item",
            data: { wishlistid: wishlistid },
            success: function (data) {
                $(".totalWishlistItems").html(data.totalWishlistItems);
                $(".appendWishlistItems").html(data.view);
            },
            error: function () {
                alert("error");
            },
        });
    });

     // -----------WISHLIST OPERATIONS END----------------- //


     // -----------ORDER RELATED OPERATIONS----------------- //
    $(document).on("click", ".btnCancelOrder", function () {
        var reason = $("#cancelReason").val();
        if (reason == "") {
            alert("Please Select a Reason");
            return false;
        }

        var result = confirm("Are you sure you want to Cancel this Product");

        if (!result) {
            return false;
        }
    });

    $("#returnExchange").change(function () {
        var return_exchange = $(this).val();
        if (return_exchange == "Exchange") {
            $(".productSizes").show();
        } else {
            $(".productSizes").hide();
        }
    });

    $("#returnProduct").change(function () {
        var product_info = $(this).val();
        var return_exchange = $("#returnExchange").val();

        if (return_exchange == "Exchange") {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "post",
                url: "/user/get-product-sizes",
                data: { product_info: product_info },
                success: function (data) {
                    //    alert(data);
                    $("#productSize").html(data);
                },
                error: function () {
                    alert("Error");
                },
            });
        }
    });

    $(document).on("click", ".btnReturnOrder", function () {
        var return_exchange = $("#returnExchange").val();
        var returnproduct = $("#returnProduct").val();
        var reason = $("#returnReason").val();

        if (return_exchange == "") {
            alert("Please select if You want to Exchange or Return");
            return false;
        }

        if (returnproduct == "") {
            alert("Please select a product which you want to return");
            return false;
        }
        if (reason == "") {
            alert("Please Select a Reason");
            return false;
        }

        var result = confirm("Are you sure you want to Return this Product");

        if (!result) {
            return false;
        }
    });

     // -----------ORDER RELATED OPERATIONS END----------------- //



    //RazorPay Payment Integration//
    $(document).on("click", ".razorpay_form", function (e) {
        e.preventDefault();

        var data = new FormData($(".razorpay_form")[0]);
        var url = $(this).attr("action");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url: url,
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function (responsea) {
                if (responsea.status == "1") {
                    var options = {
                        key: "rzp_test_tjC4YIr3QSZeME", // Enter the Key ID generated from the Dashboard
                        amount: responsea.amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        currency: responsea.currency,
                        name: "Shopeasy E-commerce", //your business name
                        description: "Test Transaction",
                        image: "https://example.com/your_logo",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        handler: function (response) {
                            $.ajax({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                method: "post",
                                url: "/user/payment/success",
                                data: {
                                    order_id: responsea.order_id,
                                    user_id: responsea.user_id,
                                    payment_id: response.razorpay_payment_id,
                                    payer_email: responsea.email,
                                    amount: responsea.amount,
                                    currency: responsea.currency,
                                    payment_status: "Paid",
                                },
                                success: function (responseb) {
                                    Swal.fire(responseb.message);
                                    window.location = responseb.redirect_url;
                                },
                            });
                        },
                        prefill: {
                            //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                            name: responsea.name, //your customer's name
                            email: responsea.email,
                            contact: responsea.contact, //Provide the customer's phone number for better conversion rates
                        },
                        notes: {
                            address: "Razorpay Corporate Office",
                        },
                        theme: {
                            color: "#3399cc",
                        },
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            },
        });
    });



  
    
});
