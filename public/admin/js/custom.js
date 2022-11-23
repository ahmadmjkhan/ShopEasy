$(document).ready(function() {

    $(document).on('submit', '.form_operation', function(e) {
        alert('hello');
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
                // 
                if (response.status == '0') {

                    $.each(response.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);

                    });
                } else {

                    // $('.form_operation')[0].reset();

                    $(function() {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        toastr.success(response.message);


                        // Toast.fire({
                        //     icon: 'success',
                        //     title: response.message,
                        // });

                    });
                    // window.location=response.redirect_url; // for redirect location//
                    setTimeout(function() { window.location = response.redirect_url; }, 2000);
                }
            }
        });
    });







    $(document).on('submit', '.delete_form_operation', function(e) {
        e.preventDefault();

        let url = $(this).attr('action');
        let data = new FormData($('.delete_form_operation')[0]);

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
                    method: 'post',
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,

                    success: function(response) {

                        if (response.status == '1') {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('.page-reload').load(location.href + " .page-reload"); //reload only specific card not whole page //
                        }

                    }
                })

            } else if (result.dismiss) {
                Swal.fire(
                    'Cancelled!',
                    'Your file has been Safe.',
                    'error'
                )
            }

        })



    })



    $(document).on('click', '.updatebannerstatus', function() {
        var status = $(this).children("i").attr('status');
        var banner_id = $(this).attr('banner_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-banner-status',
                    data: { status: status, banner_id: banner_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#banner-" + banner_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#banner-" + banner_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatesectionstatus', function() {
        var status = $(this).children("i").attr('status');
        var section_id = $(this).attr('section_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-section-status',
                    data: { status: status, section_id: section_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#section-" + section_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#section-" + section_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatecategorystatus', function() {

        var status = $(this).children("i").attr('status');
        var category_id = $(this).attr('category_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-category-status',
                    data: { status: status, category_id: category_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#category-" + category_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#category-" + category_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatepopularcategory', function() {

        var status = $(this).children("i").attr('status');
        var category_id = $(this).attr('category_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-category-popular',
                    data: { status: status, category_id: category_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#popular-" + category_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#popular-" + category_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatebrandstatus', function() {
        alert('helo');
        var status = $(this).children("i").attr('status');
        var brand_id = $(this).attr('brand_id');
        // alert(status);
        // alert(brand_id);

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-brand-status',
                    data: { status: status, brand_id: brand_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#brand-" + brand_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#brand-" + brand_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }

                    },
                    error: function() {
                        alert('error');
                    },
                });

            }
        });
    });

    $(document).on('click', '.updatebrandpopular', function() {
        var popular = $(this).children("i").attr('status');
        var brand_id = $(this).attr('brand_id');
        // alert(status);
        // alert(brand_id);

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Popularity",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Popular',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-brand-popular',
                    data: { popular: popular, brand_id: brand_id },

                    success: function(resp) {
                        if (resp['popular'] == 0) {
                            $("#popular-" + brand_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Popular Changed!',
                                'Your Popular Is Now InActive',
                                'success'
                            )
                        } else if (resp['popular'] == 1) {
                            $("#popular-" + brand_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Popular Changed!',
                                'Your Popular Is Now Active',
                                'success'
                            )
                        }

                    },
                    error: function() {
                        alert('error');
                    },
                });

            }
        });



    });

    $(document).on('click', '.updatefilterstatus', function() {


        var status = $(this).children("i").attr('status');
        var filter_id = $(this).attr('filter_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-filter-status',
                    data: { status: status, filter_id: filter_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#filter-" + filter_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#filter-" + filter_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatefiltervaluestatus', function() {


        var status = $(this).children("i").attr('status');
        var filter_value_id = $(this).attr('filter_value_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-filter-value-status',
                    data: { status: status, filter_value_id: filter_value_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#filter_value-" + filter_value_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#filter_value-" + filter_value_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updateattributestatus', function() {


        var status = $(this).children("i").attr('status');
        var attribute_id = $(this).attr('attribute_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-attribute-status',
                    data: { status: status, attribute_id: attribute_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#attribute-" + attribute_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#attribute-" + attribute_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatestatusimages', function() {


        var status = $(this).children("i").attr('status');
        var image_id = $(this).attr('image_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-multiple-images-status',
                    data: { status: status, image_id: image_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#images-" + image_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#images-" + image_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updateadminstatus', function() {


        var status = $(this).children("i").attr('status');
        var admin_id = $(this).attr('admin_id');


        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-admins-status',
                    data: { status: status, admin_id: admin_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#admin-" + admin_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#admin-" + admin_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updateuserstatus', function() {


        var status = $(this).children("i").attr('status');
        var user_id = $(this).attr('user_id');


        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-users-status',
                    data: { status: status, user_id: user_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#user-" + user_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#user-" + user_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $(document).on('click', '.updatesellerstatus', function() {


        var status = $(this).children("i").attr('status');
        var seller_id = $(this).attr('seller_id');


        Swal.fire({
            title: 'Are you sure?',
            text: "Want To Change The Status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Status',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type: 'post',
                    url: '/admin/update-sellers-status',
                    data: { status: status, seller_id: seller_id },

                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#seller-" + seller_id).html("<i class='icon-copy fa fa-toggle-off fa-lg'  status='InActive'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now InActive',
                                'success'
                            )
                        } else if (resp['status'] == 1) {
                            $("#seller-" + seller_id).html("<i class='icon-copy fa fa-toggle-on fa-lg'  status='Active'></i>");
                            Swal.fire(
                                'Status Changed!',
                                'Your Status Is Now Active',
                                'success'
                            )
                        }
                    },
                    // error:function(){
                    //   alert('error');
                    // },
                });
            }


        })

    });

    $('#section_id').change(function() {
        var section_id = $(this).val();
        // alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/append-categories-level',
            data: { section_id: section_id },
            success: function(resp) {

                $('#appendCategoriesLevel').html(resp);
            },
            error: function() {
                alert('error');
            }
        })


    })


    // get filter on change the category in add-edit-products //

    $(".categoryfilter").on('change', function() {
        alert('hel');

        var category_id = $(this).val();

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'post',
            url: 'category-filters',
            data: { category_id: category_id },
            success: function(resp) {
                $(".loadFilters").html(resp.view);
            }
        });
    });


    // Add Remove Input Fields //

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="size[]" placeholder="Size" style="width:120px"/>&nbsp;<input type="text" name="sku[]" placeholder="Sku" style="width:120px"/>&nbsp;<input type="text" name="price[]" placeholder="price" style="width:120px"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:120px"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});