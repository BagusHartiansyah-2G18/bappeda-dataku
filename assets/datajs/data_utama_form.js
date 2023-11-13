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
                nama_elemen: {
                    required: true
                },
                id_urusan: {
                    required: true
                },
                id_dinas: {
                    required: true
                },
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
                            setTimeout(function(){window.location.reload()},100);
                        }
                        if (data.error == true) {
                            swal.fire('Error','Gagal Disimpan','error');
                        }
                    }
                });
            }
        });
    }

    var nilai = function(){
        var tambah_nilai  = $('#tambah_nilai');
        var tbl_nilai = $('#tbl_nilai');
        var nilai  = `<tr>
                        <td>
                            <div class="form-group">
                                `+thn+`
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                `+thn_n+`
                            </div>
                        </td>
                    </tr>`;

        tambah_nilai.on('click', function(e){
            e.preventDefault();
            tbl_nilai.append(nilai);
        });

        tbl_nilai.on('click',"#remove", function(e){
            e.preventDefault(); $(this).closest('tr').remove();
        }); 
    }

    var urusan = function(){
        $('#id_urusan').on('change', function(){
            var id =  $(this).val();
            console.log(id);
            $.ajax({
                url : site_url + '/data/get_par/' +id,
                data : {id_parent : id_parent},
                method : 'post',
                success : function(data){
                    $('#id_parent').html(data);
                }
            });
        }).change();
    }

    return {
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            initValidation();
            initSubmit();
            nilai();
            urusan();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});
