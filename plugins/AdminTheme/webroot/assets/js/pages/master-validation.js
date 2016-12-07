    $(document).ready(function() {
    $('#frRequestComment').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            txtComment: {
                validators: {
                    notEmpty: {
                        message: 'コメントが必要なので、必ず入力してください'
                    }
                }
            }
        },
        submitHandler: function (form) {
            // console.log($("form").serialize());
            $.ajax({
                type: "POST",
                url:   '/comment/add_ajax.json',
                dataType: 'text',
                async:false,
                data:  $("#frRequestComment").serialize(),
                success: function (data) {
                    var returnedData = JSON.parse(data);
                    $('.listComment').prepend(returnedData.content);
                    $('#frRequestComment').trigger('reset');
                    console.log(data);
                    return true;
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });

    $('#frChangeStatusRequest').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                txtComment: {
                    validators: {
                        notEmpty: {
                            message: 'コメントが必要なので、必ず入力してください'
                        }
                    }
                }
            },
            submitHandler: function (form) {
                console.log($("form").serialize());
                $.ajax({
                    type: "POST",
                    url:   "/request/change_status.json",
                    dataType: 'text',
                    data:  $("#frChangeStatusRequest").serialize(),
                    success: function(data)
                    {

                        console.log(data);
                        var returnedData = JSON.parse(data);
                        $("#md-add-request-status").removeClass("md-show");
                        location.reload();
                    //     <?php if($userInfo->role[0]->name === 'top'){?>
                    //     if($this.data("mode") === 'app') {
                    //         $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
                    //     }else {
                    //         $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    //     }
                    // <?php }elseif($userInfo->role[0]->name === 'staff'){}else{ ?>
                    //     if($this.data("mode") === 'app') {
                    //         $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
                    //     }else {
                    //         $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    //     }
                    // <?php } ?>
                    //     var btnAction = $this.parent();
                    //     btnAction.empty();
                    //     $("[class='tooltip fade top in']").remove();
                    //     btnAction.html('<a href="/request/preview/'+returnedData.result.response.id+'" class="btn btn-primary" title="" data-toggle="tooltip" data-value="'+returnedData.result.response.id+'" data-mode="pre" data-original-title="Preview"><i class="icon-eye-off"></i></a>');
                    //
                    }
                });




                return false; // required to block normal submit since you used ajax
            }
        });

    $('#createDepartment').bootstrapValidator({
        message: '入力した文字が無効です',
        fields: {
            dep_name: {
                message: '無効な事業部名です',
                validators: {
                    notEmpty: {
                        message: 'コメントが必要なので、必ず入力してください'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: '事業部名を３～３０文字で入力してください'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: '事業部名はアルファベット、数字、「.」以外入力できません'
                    }
                }
            },
            dep_tel: {
                validators: {
                    digits: {
                        message: '電話番号は数字以外入力できません'
                    }
                }
            },
            dep_address: {
                validators: {
                    notEmpty: {
                        message: '住所入力が必要です'
                    },
                    stringLength: {
                        min: 3,
                        message: '住所を６文字以上入力してください'
                    }
                }
            }
        },
        submitHandler: function (form) {
            var url =  "/department/add.json";
            if($('#department_id').length)
            {
                var url =  "/department/edit-ajax.json";
            }
            $.ajax({
                type: "POST",
                url:   url,
                dataType: 'text',
                async:false,
                data: $("form").serialize(),
                success: function (data) {
                    console.log(data);
                    $("#md-add-department").removeClass("md-show");
                    resetDepartmentForm();
                    window.setTimeout(function () {$("#md-add-department").remove();},500);
                    var res = JSON.parse(data);
                    notify('success',{title: res.result.status ,message: res.result.response,position:'top center'});
                    location.reload();
                    return true;
                }
            });
            return false; // required to block normal submit since you used ajax
        },
    });

    $('#resetPassword').bootstrapValidator({
        message: 'パスワードが無効です',
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'パスワードが必要なので、かならず入力してください'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'パスワードと確認されるパスワードは一致されていません'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'パスワード確認が必要なので、かならず入力してください'
                    },
                    identical: {
                        field: 'password',
                        message: 'パスワードと確認されるパスワードは一致されていません'
                    }
                }
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url:   "save_profile.json",
                dataType: 'text',
                async:false,
                data: $("form").serialize(),
                success: function (data) {
                    var res = JSON.parse(data);
                    console.log(data);
                    notify('success',{title:'Update!!!',message: res.result.response});
                    //location.reload();
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });

    $('#createUser').bootstrapValidator({
        message: 'このユーザーは無効です',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'メールアドレスが必要なので、かならず入力してください'
                    },
                    emailAddress: {
                        message: '入力されたメールアドレスが無効です'
                    }
                }
            },
            username: {
                message: 'ユーザー名が無効です',
                validators: {
                    notEmpty: {
                        message: 'ユーザー名が必要なので、かならず入力してください'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'ユーザー名は３～３０文字で入力してください'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'ユーザー名はアルファベット、数字、「.」以外入力できません'
                    }
                }
            },

            role_id: {
                validators: {
                    notEmpty: {
                        message: '権限が必要なので、かならず入力してください'
                    }
                }
            },
            dep_id: {
                validators: {
                    notEmpty: {
                        message: '事業部が必要なので、かならず入力してください'
                    }
                }
            },

            password: {
                validators: {
                    notEmpty: {
                        message: 'パスワードが必要なので、かならず入力してください'
                    },
                    identical: {
                        field: 'password_confirmation',
                        message: 'パスワードと確認されるパスワードは一致されていません'
                    },
                    different: {
                        field: 'username',
                        message: 'パスワードをユーザー名と同じのようにしないでください'
                    }
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: '確認するパスワードが必要なので、かならず入力してください'
                    },
                    identical: {
                        field: 'password',
                        message: 'パスワードと確認されるパスワードは一致されていません'
                    },
                    different: {
                        field: 'username',
                        message: 'パスワードをユーザー名と同じのようにしないでください'
                    }
                }
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: "POST",
                url:   "checkunique.json",
                dataType: 'text',
                data: $("form").serialize(),
                success: function (data) {
                    var returnedData = JSON.parse(data);
                    if(returnedData.result.status){
                        $.ajax({
                            type: "POST",
                            url: "add.json",
                            dataType: 'text',
                            data: $("form").serialize(),
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            },
                            success: function (response) {
                                var res = JSON.parse(response);
                                $( ".alertMessage" ).replaceWith( res.content );
                                $('#createUser').trigger('reset');
                                notify('success',{title:'Success!!!',message: returnedData.result.response,position:'top center'});
                            }
                        });
                    }else {
                        if(returnedData.result.mode === 1)
                        {
                            $("#email").parent().switchClass("has-success","has-error");
                            $("#email").focus();
                            notify('error',{title:'Alert!!!',message: returnedData.result.response,position:'top center'});

                        }else if(returnedData.result.mode === 2){
                            $("#username").parent().switchClass("has-success","has-error");
                            $("#email").focus();
                            notify('error',{title:'Alert!!!',message: returnedData.result.response,position:'top center'});
                        }
                        else if(returnedData.result.mode === 3){
                            $("#role_id").parent().switchClass("has-success","has-error");
                            $("#role_id").focus();
                            notify('error',{title:'Alert!!!',message: returnedData.result.response,position:'top center'});
                        }
                        else {
                        //    do something
                        }
                    }

                }
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;

        },
    });
    var isUpdateProfile = false;
    $('#editProfile').bootstrapValidator({
        message: '編集された情報が無効です',
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: '名字が必要なので、かならず入力してください'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: '名前が必要なので、かならず入力してください'
                    }
                }
            },
            phone_num: {
                validators: {
                    digits: {
                        message: '有効な電話番号を入力してください'
                    }
                }
            },
            timezone: {
                validators: {
                    notEmpty: {
                        message: '時間帯が必要なので、かならず選択してください'
                    }
                }
            },
            birthday: {
                validators: {
                    notEmpty: {
                        message: '誕生日が必要なので、かならず選択してください'
                    },
                    date: {
                        message: '有効な日付を選択してください',
                        format: 'YYYY/MM/DD'
                    }
                }
            }
        },
        submitHandler: function (form) {
            isUpdateProfile = true;
        }
    });
    var isAddRequest = false;
    $('#frRequest').bootstrapValidator({
        fields: {
            sltCategory: {
                validators: {
                    notEmpty: {
                        message: 'カテゴリが必要なので、かならず選択してください'
                    },
                }
            },
            txtPrice: {
                validators: {
                    notEmpty: {
                        message: '単価が必要なので、かならず入力してください'
                    },
                    digits: {
                        message: '単価が数字しか入力されていません'
                    },
                    callback: {
                        // message: 'This '+ $('#sltCategory').val() +' category have a minimum price must be up',
                        callback: function(value, validator) {
                            var cate = $('#sltCategory').val();
                            // if(!$('#sltCategory').val() || 0 === $('#sltCategory').val().length){
                            //     validator.updateStatus('sltCategory', 'INVALID ', 'notEmpty');
                            // }
                            if(value < 10000 && cate === '4' )
                            {
                                // var fields = validator.getMessageContainer('txtPrice');
                                // alert(fields);exit;
                                // validator.option.message = 'This \''+ $('#sltCategory').val() +'\' category have a minimum sale price must be up';

                                $("small[data-bv-validator-for='txtPrice']:last").html(
                                    'This \' '+ $('#sltCategory').find(":selected").text() +' \' category have a minimum price must be up 10.000'
                                );
                                return false;
                            }else if(value < 5000 && cate === '6'){
                                // validator.option.message = 'This \''+ $('#sltCategory').val() +'\' category have a minimum sale price must be up';
                                $("small[data-bv-validator-for='txtPrice']:last").html(
                                    'This \''+ $('#sltCategory').find(":selected").text() +'\' category have a minimum price must be up 5.000'
                                );
                                return false;
                            }
                            // var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return true;
                        }
                    }
                }
            },
            txtApproveDate: {
                validators: {
                    notEmpty: {
                        message: '承認日が必要なので、かならず選択してください'
                    },
                    date: {
                        message: '有効な日付を選択してください',
                        format: 'YYYY/MM/DD'
                    }
                }
            },
            txtPaymentDate: {
                validators: {
                    notEmpty: {
                        message: '支払日が必要なので、かならず選択してください'
                    },
                    date: {
                        message: '有効な日付を選択してください',
                        format: 'YYYY/MM/DD'
                    }
                }
            },
            txtTitle: {
                validators: {
                    notEmpty: {
                        message: 'タイトルが必要なので、かならず入力してください'
                    }
                }
            },
            txtDescription: {
                validators: {
                    notEmpty: {
                        message: '内容が必要なので、かならず入力してください'
                    }
                }
            },
            txtReason: {
                validators: {
                    notEmpty: {
                        message: '理由が必要なので、かならず入力してください'
                    }
                }
            }
        },
        submitHandler: function (form) {
            isAddRequest = true;
        }
    });
    $('#txtApproveDate')
        .on('changeDate show', function(e) {
            // Validate the date when user change it
            $('#frRequest')
                .bootstrapValidator('updateStatus', 'txtApproveDate', 'NOT_VALIDATED')
                .bootstrapValidator('validateField', 'txtApproveDate');
        });
    $('#txtPaymentDate')
            .on('changeDate show', function(e) {
                // Validate the date when user change it
                $('#frRequest')
                    .bootstrapValidator('updateStatus', 'txtPaymentDate', 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', 'txtPaymentDate');
            });
    $("#frRequest").on('submit',(function(e) {
            if(isAddRequest){
                $.ajax({
                    type: "POST",
                    url:   "/request/addRequest.json",
                    dataType: 'text',
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        var returnedData = JSON.parse(data);
                        $('#listRequests tr:eq(1)').before(returnedData.content);

                        if(returnedData.result.status === 'Success'){
                            $("#alertDiv").removeClass("alert-danger");
                            $("#alertDiv").addClass("alert-info");
                        }else{
                            $("#alertDiv").removeClass("alert-info");
                            $("#alertDiv").addClass("alert-danger");
                        }

                        $("#alertHeader").text(returnedData.result.status);
                        $("#alertMessage").text(returnedData.result.response);
                        $("#alertMessage").text(returnedData.result.response);
                        setTimeout(function () {
                            $("#alert-modal").removeClass("md-show");
                        }, 8000);
                        $("#md-add-request").removeClass("md-show");
                        $('#frRequest').trigger('reset');
                        $("#alert-modal").addClass("md-show");
                        isAddRequest = false;
                        console.log(data);
                        updateIndex($('#listRequests tr'));
                        $('#listRequests tr:last').remove();

                        // location.reload();
                    },
                    error: function()
                    {

                    }
                })
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }

            return false;
}));


        var isValidate = false;
        $('#frRequest1').bootstrapValidator({
            fields: {
                sltCategory: {
                    validators: {
                        notEmpty: {
                            message: 'カテゴリが必要なので、かならず選択してください'
                        },
                    }
                },
                txtPrice: {
                    validators: {
                        notEmpty: {
                            message: '単価が必要なので、かならず入力してください'
                        },
                        digits: {
                            message: '単価が数字しか入力されていません'
                        },
                        callback: {
                            // message: 'This '+ $('#sltCategory').val() +' category have a minimum price must be up',
                            callback: function(value, validator) {
                                var cate = $('#sltCategory').val();
                                // if(!$('#sltCategory').val() || 0 === $('#sltCategory').val().length){
                                //     validator.updateStatus('sltCategory', 'INVALID ', 'notEmpty');
                                // }
                                if(value < 10000 && cate === '4' )
                                {
                                    // var fields = validator.getMessageContainer('txtPrice');
                                    // alert(fields);exit;
                                    // validator.option.message = 'This \''+ $('#sltCategory').val() +'\' category have a minimum sale price must be up';

                                    $("small[data-bv-validator-for='txtPrice']:last").html(
                                        'This \' '+ $('#sltCategory').find(":selected").text() +' \' category have a minimum price must be up 10.000'
                                    );
                                    return false;
                                }else if(value < 5000 && cate === '6'){
                                    // validator.option.message = 'This \''+ $('#sltCategory').val() +'\' category have a minimum sale price must be up';
                                    $("small[data-bv-validator-for='txtPrice']:last").html(
                                        'This \''+ $('#sltCategory').find(":selected").text() +'\' category have a minimum price must be up 5.000'
                                    );
                                    return false;
                                }
                                // var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                                return true;
                            }
                        }
                    }
                },
                txtApproveDate: {
                    validators: {
                        notEmpty: {
                            message: '承認日が必要なので、かならず選択してください'
                        },
                        date: {
                            message: '有効な日付を選択してください',
                            format: 'YYYY/MM/DD'
                        }
                    }
                },
                txtPaymentDate: {
                    validators: {
                        notEmpty: {
                            message: '支払日が必要なので、かならず選択してください'
                        },
                        date: {
                            message: '有効な日付を選択してください',
                            format: 'YYYY/MM/DD'
                        }
                    }
                },
                txtTitle: {
                    validators: {
                        notEmpty: {
                            message: 'タイトルが必要なので、かならず入力してください'
                        }
                    }
                },
                txtDescription: {
                    validators: {
                        notEmpty: {
                            message: '内容が必要なので、かならず入力してください'
                        }
                    }
                },
                txtReason: {
                    validators: {
                        notEmpty: {
                            message: '理由が必要なので、かならず入力してください'
                        }
                    }
                }
            },
            submitHandler: function (form) {
                isValidate = true;
            }
        });
        $('#txtApproveDate')
            .on('changeDate show', function(e) {
                // Validate the date when user change it
                $('#frRequest1')
                    .bootstrapValidator('updateStatus', 'txtApproveDate', 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', 'txtApproveDate');
            });
        $('#txtPaymentDate')
            .on('changeDate show', function(e) {
                // Validate the date when user change it
                $('#frRequest1')
                    .bootstrapValidator('updateStatus', 'txtPaymentDate', 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', 'txtPaymentDate');
            });
        $("#frRequest1").on('submit',(function(e) {
            if(isValidate){
                $.ajax({
                    type: "POST",
                    url:   "/request/addOrEdit.json",
                    dataType: 'text',
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        console.log(data);
                        var returnedData = JSON.parse(data);
                        $('#frRequest1 > #request_id').val('');
                        if(returnedData.result.action === 'add'){
                            $('#listRequests tr:eq(1)').before(returnedData.content);
                            updateIndex($('#listRequests tr'));
                            if($('#listRequests tr').length < 1){
                                location.reload();
                            }
                            if($('#listRequests tr').length > 21)
                            {
                                $('#listRequests tr:last').remove();
                            }

                        }else{
                            location.reload();
                        }
                        if(returnedData.result.status === 'Success'){
                            $("#alertDiv").removeClass("alert-danger");
                            $("#alertDiv").addClass("alert-info");
                        }else{
                            $("#alertDiv").removeClass("alert-info");
                            $("#alertDiv").addClass("alert-danger");
                        }
                        $("#alertHeader").text(returnedData.result.status);
                        $("#alertMessage").text(returnedData.result.response);
                        $("#alertMessage").text(returnedData.result.response);
                        setTimeout(function () {
                            $("#alert-modal").removeClass("md-show");
                        }, 8000);
                        $("#md-edit-request").removeClass("md-show");
                        $('#frRequest1').trigger('reset');
                        $("#alert-modal").addClass("md-show");
                        isValidate = false;
                    },
                    error: function()
                    {

                    }
                })
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }
            return false;
        }));



    $('#birthday')
        .on('changeDate show', function(e) {
            $('#editProfile')
                .bootstrapValidator('updateStatus', 'birthday', 'NOT_VALIDATED')
                .bootstrapValidator('validateField', 'birthday');
    });



    $("#editProfile").on('submit',(function(e) {
        if(isUpdateProfile){
            $.ajax({
                type: "POST",
                url:   "save_profile.json",
                dataType: 'text',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    isUpdateProfile = false;
                    console.log(data);
                     location.reload();
                }
            })
        }

        return false;
    }));




});
function updateIndex(el)
{
    $(el).each(function(index){
        console.log($( this ).find( "td:eq(3)" ).html());
        $( this ).find( "td:first" ).html( index);
    });
}