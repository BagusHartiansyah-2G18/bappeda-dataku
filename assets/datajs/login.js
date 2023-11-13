"use strict";

// Class Definition
var KTLoginGeneral = function() {
    var handleSignInFormSubmit = function() {
        $('#kt_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var username = form.find('#username').val();
            var password = form.find('#password').val();

            form.validate({
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            //btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

            KTApp.progress(btn);

            form.ajaxSubmit({
                url: site_url + 'login/cek_login',
                data : {username : username, password:password}, 
                type : "POST",
                dataType : "JSON",
                success: function(data) {
                    KTApp.unprogress(btn);
                	if(data.error==false){
                        swal.fire({
                            title: '',
                            text: data.message,
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function(){location.href= site_url + 'admin'},1000);
                    }
                    if (data.error == true) {
                        swal.fire('Error',data.message,'error');
                    }
                }
            });
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            handleSignInFormSubmit();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLoginGeneral.init();
});
