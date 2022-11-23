$(document).ready(function() {

    $(document).on('submit', '.form_operation', function(e) {
        alert('helo');

        e.preventDefault();

        let url = $(this).attr('action');


        let data = new FormData($('.form_operation')[0]);



        $.ajax({


            url: url,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {

                $(document).find('span.error-text').text('');
            },

            success: function(response) {

                if (response.status == '0') {

                    $.each(response.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);

                    });

                } else if (response.status == '2') {
                    // for invalid username and password show //
                    $('.error_message').show();
                    $('.error_message').html(response.message);

                    setTimeout(function() {
                        $('.error_message').fadeOut('slow');
                    }, 3000);
                } else {
                    $('.form_operation')[0].reset();

                    $('.success_message').show();
                    $('.success_message').html(response.message);

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
                    setTimeout(function() { window.location = response.redirect_url; }, 2000);
                }





            }
        });





    });
});