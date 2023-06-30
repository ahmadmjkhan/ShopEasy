$(document).ready(function () {
    $(document).on("submit", ".form_operation", function (e) {
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
                //
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    // $('.form_operation')[0].reset();
                    $(".form_operation")[0].reset();
                    $(".success_message").show();
                    $(".success_message").html(response.message);

                    //Success Message

                    Swal.fire(response.message, "success");
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".all_details_form_operation", function (e) {
        e.preventDefault();

        var url = $(this).attr("action");
        var data = new FormData($(".all_details_form_operation")[0]);

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
                //
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else {
                    // $('.form_operation')[0].reset();
                    $(".all_details_form_operation")[0].reset();
                    $(".success_message").show();
                    $(".success_message").html(response.message);

                    //Success Message

                    // Swal.fire(response.message, "success");
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".login_form_operation", function (e) {
        e.preventDefault();

        var url = $(this).attr("action");
        var data = new FormData($(".login_form_operation")[0]);

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
                //
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                    });
                } else if (response.status == "1") {
                    $(".error_message").show();
                    $(".error_message").html(response.message);
                    setTimeout(function () {
                        $(".error_message").hide();
                    }, 3000);
                } else if (response.status == "2") {
                    $(".error_message").show();
                    $(".error_message").html(response.message);
                    setTimeout(function () {
                        $(".error_message").hide();
                        window.location = response.redirect_url;
                    }, 3000);
                } else if (response.status == "4") {
                    $(".error_message").show();
                    $(".error_message").html(response.message);
                    setTimeout(function () {
                        $(".error_message").hide();
                    }, 3000);
                } else {
                    $(".login_form_operation")[0].reset();
                    $(".success_message").show();
                    $(".success_message").html(response.message);
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 2000);
                }

                // $(function () {
                // var Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                // toastr.success(response.message);
                // Toast.fire({
                //     icon: 'success',
                //     title: response.message,
                // });
                // });
                // window.location=response.redirect_url; // for redirect location//
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

    $(document).on("submit", ".change_password_form_operation", function (e) {
        e.preventDefault();

        var url = $(this).attr("action");
        var data = new FormData($(".change_password_form_operation")[0]);

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
                //
                if (response.status == "0") {
                    $(".con-pass").show();
                    $(".con-pass").html(response.message);
                } else if (response.status == "2") {
                    $(".current-password").show();
                    $(".current-password").html(response.message);
                } else {
                    $(".change_password_form_operation")[0].reset();
                    $(".success_message").show();
                    $(".success_message").html(response.message);
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 2000);
                }
            },
        });
    });

    $(document).on("submit", ".register_form_operation", function (e) {
        alert('hello');
        e.preventDefault();
        $(".div-container").show();

        var url = $(this).attr("action");
        var data = new FormData($(".register_form_operation")[0]);

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
                //
                if (response.status == "0") {
                    $.each(response.error, function (prefix, val) {
                        $("span." + prefix + "_error").text(val[0]);
                        //spinner//
                        $(".div-container").hide();
                    });
                } else {
                    $(".register_form_operation")[0].reset();
                    $(".success_message").show();
                    $(".success_message").html(response.message);
                    //spinner//
                    $(".div-container").hide();
                    // setTimeout(function () {
                    //     window.location = response.redirect_url;
                    // }, 2000);
                }

                // $(function () {
                // var Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                // toastr.success(response.message);
                // Toast.fire({
                //     icon: 'success',
                //     title: response.message,
                // });
                // });
                // window.location=response.redirect_url; // for redirect location//
            },
        });
    });

    $(document).on("submit", ".delete_form_operation", function (e) {
        e.preventDefault();

        let url = $(this).attr("action");
        let data = new FormData($(".delete_form_operation")[0]);

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
                    method: "post",
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        if (response.status == "1") {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            $(".page-reload").load(
                                location.href + " .page-reload"
                            ); //reload only specific card not whole page //
                        }
                    },
                });
            } else if (result.dismiss) {
                Swal.fire("Cancelled!", "Your file has been Safe.", "error");
            }
        });
    });

    $("#section_id").change(function () {
        var section_id = $(this).val();
        // alert(section_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "get",
            url: "/admin/append-categories-level",
            data: { section_id: section_id },
            success: function (resp) {
                $("#appendCategoriesLevel").html(resp);
            },
            error: function () {
                alert("error");
            },
        });
    });

    // get filter on change the category in add-edit-products //

    $(".categoryfilter").on("change", function () {
        alert("hel");

        var category_id = $(this).val();
        alert(category_id);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            type: "post",
            url: "category-filters",
            data: { category_id: category_id },
            success: function (resp) {
                $(".loadFilters").html(resp.view);
            },
        });
    });

    $(document).on("click", ".updatestatusimages", function () {
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");

        Swal.fire({
            title: "Are you sure?",
            text: "Want To Change The Status",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Change Status",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },

                    type: "post",
                    url: "/admin/update-multiple-images-status",
                    data: { status: status, image_id: image_id },

                    success: function (resp) {
                        if (resp["status"] == 0) {
                            $("#images-" + image_id).html(
                                "<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>"
                            );
                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now InActive",
                                "success"
                            );
                        } else if (resp["status"] == 1) {
                            $("#images-" + image_id).html(
                                "<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>"
                            );
                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now Active",
                                "success"
                            );
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }
        });
    });

    $(document).on("click", ".updateattributestatus", function () {
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");

        Swal.fire({
            title: "Are you sure?",
            text: "Want To Change The Status",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Change Status",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },

                    type: "post",
                    url: "/seller/update-attribute-status",
                    data: { status: status, attribute_id: attribute_id },

                    success: function (resp) {
                        if (resp["status"] == 0) {
                            $("#attribute-" + attribute_id).html(
                                "<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>"
                            );

                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now InActive",
                                "success"
                            );
                        } else if (resp["status"] == 1) {
                            $("#attribute-" + attribute_id).html(
                                "<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>"
                            );

                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now Active",
                                "success"
                            );
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            } else if (result.dismiss) {
                Swal.fire("Cancelled!", "Your file has been Safe.", "error");
            }
        });
    });

    $(document).on("click", ".updatecouponstatus", function () {
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");

        Swal.fire({
            title: "Are you sure?",
            text: "Want To Change The Status",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Change Status",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },

                    type: "post",
                    url: "/seller/update-coupons-status",
                    data: { status: status, coupon_id: coupon_id },

                    success: function (resp) {
                        if (resp["status"] == 0) {
                            $("#seller_coupon-" + coupon_id).html(
                                "<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>"
                            );
                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now InActive",
                                "success"
                            );
                        } else if (resp["status"] == 1) {
                            $("#seller_coupon-" + coupon_id).html(
                                "<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>"
                            );
                            Swal.fire(
                                "Status Changed!",
                                "Your Status Is Now Active",
                                "success"
                            );
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }
        });
    });

    // Add Remove Input Fields //

    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div><input type="text" name="size[]" placeholder="Size" style="width:120px"/>&nbsp;<input type="text" name="sku[]" placeholder="Sku" style="width:120px"/>&nbsp;<input type="text" name="price[]" placeholder="price" style="width:120px"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:120px"/>&nbsp;<a href="javascript:void(0);" class="remove_button mt-1 btn btn-sm btn-danger">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(".Manual-Coupon").click(function () {
        $(".coupon-field").show();
    });

    $(".Automatic-Coupon").click(function () {
        $(".coupon-field").hide();
    });
});
