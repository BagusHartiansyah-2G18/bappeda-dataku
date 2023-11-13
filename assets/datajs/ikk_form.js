"use strict";
var KTWizard2 = function () {
// ================= Identifikasi ====================      
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

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
                id_urusan: {
                    required: true
                },
                nama_ikk: {
                    required: true
                },
                id_dinas: {
                    required: true
                },
                data_1: {
                    required: true
                },
                data_2: {
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

    var initUrusan = function(){
        $('#d1_urusan').on('change', function(){
            getPar($(this).val(),'.data_1','');
        });

        $('#d2_urusan').on('change', function(){
            getPar($(this).val(),'.data_2','');
        });
    }

    var initAddElemen = function(){
        var tambah_el  = $('#tambah_el');
        var tbl_data2 = $('#tbl_data2');

        var tambah_el_1  = $('#tambah_el_1');
        var tbl_data_1 = $('#tbl_data1');
        
        var _data_2  = `<tr>
                        <td colspan="2">
                            <div class="form-group">
                                `+data_2+`
                            </div>
                        </td>
                    </tr>`;

        var _data_1  = `<tr>
                        <td colspan="2">
                            <div class="form-group">
                                `+data_1+`
                            </div>
                        </td>
                    </tr>`;


        tambah_el_1.on('click', function(e){
            e.preventDefault();
            tbl_data_1.append(_data_1);

            $.ajax({
                url : site_url + '/data/get_par/' + $('#d1_urusan').val(),
                method : 'post',
                success : function(data){
                    $('.data_1').last().html(data);
                }
            });
        });

        tambah_el.on('click', function(e){
            e.preventDefault();
            tbl_data2.append(_data_2);

            $.ajax({
                url : site_url + '/data/get_par/' + $('#d2_urusan').val(),
                method : 'post',
                success : function(data){
                    $('.data_2').last().html(data);
                }
            });
        });

        tbl_data_1.on('click',"#remove", function(e){
            e.preventDefault(); $(this).closest('tr').remove();
        }); 

        tbl_data2.on('click',"#remove", function(e){
            e.preventDefault(); $(this).closest('tr').remove();
        });
    }

    var getPar =  function(id,sel,idPar){
        $.ajax({
            url : site_url + '/data/get_par/' + id,
            data : {id_parent : idPar},
            method : 'post',
            success : function(data){
                $(''+sel+'').html(data);
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



    return {
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            initValidation();
            initSubmit();
            initUrusan();
            initAddElemen();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();
});
