"use strict";
var Sdgs = function () {
// ================= Identifikasi ====================      
    var formEl;
    var validator;
    var avatar1 = new KTAvatar('kt_user_avatar_1');

    var initValidation = function() {
        validator = formEl.validate({
            ignore: ":hidden",
            rules: {
                nama: {
                    required: true
                },
                desc: {
                    required: true
                },
                info: {
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
                                text: data.message,
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            setTimeout(function(){window.location.reload()},1000);
                        }
                        if (data.error == true) {
                            swal.fire('Error','Gagal Disimpan','error');
                        }
                    }
                });
            }
        });
    }

    return {
        init: function() {
            formEl = $('#kt_form');

            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    Sdgs.init();
});
