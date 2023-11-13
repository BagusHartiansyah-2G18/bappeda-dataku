"use strict";
var KTWizard2 = function () {
// ================= Identifikasi ====================      
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar1 = new KTAvatar('kt_user_avatar_1');

    var initWizard = function () {
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1,
            clickableSteps: true
        });

        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();
            }
        });

        wizard.on('beforePrev', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); 
            }
        });

        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            ignore: ":hidden",

            rules: {
                nama: {
                    required: true
                },
                username: {
                    required: true,
                },
                password: {
                    minlength : 5,
                },
                password2: {
                    minlength : 5,
                    equalTo : '#password',
                },
                email: {
                    required: true
                },
                gambar: {
                    required: (gambar == '') ? true : false,
                    extension: "png|jpg",
                    filesize: 1048576
                },
            },

            messages: {
                gambar: "File harus JPG atau PNG, Max 1 MB",
            },

            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "Ada beberapa kesalahan dalam Permohonan anda. Mohon diperbaiki",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },

            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                KTApp.progress(btn);
                formEl.ajaxSubmit({
                    type : "POST",
                    dataType : "JSON",
                    success: function(data) {
                        KTApp.unprogress(btn);
                        if(data.error==false){
                            swal.fire({
                                title: '',
                                text: data.message ? data.message : 'Gagal Disimpan',
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function(){window.location.reload()},1000);
                        }
                        if (data.error == true) {
                            swal.fire('Error',data.message,'error');
                        }
                    }
                });
            }
        });
    }

    return {
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});
