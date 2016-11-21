    $(document).ready(function() {
    $('#frRequestComment').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            txtComment: {
                validators: {
                    notEmpty: {
                        message: 'The Comment is required and can\'t be empty'
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
    $('#createDepartment').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            dep_name: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            dep_tel: {
                validators: {
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            dep_address: {
                validators: {
                    notEmpty: {
                        message: 'Message is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Message must be more than 6 characters long'
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
        message: 'This value is not valid',
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
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
        message: 'This value is not valid',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },

            role_id: {
                validators: {
                    notEmpty: {
                        message: 'The role is required and can\'t be empty'
                    }
                }
            },
            dep_id: {
                validators: {
                    notEmpty: {
                        message: 'The department is required and can\'t be empty'
                    }
                }
            },

            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password_confirmation',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
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
s                            }
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
        message: 'This value is not valid',
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required and can\'t be empty'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required and can\'t be empty'
                    }
                }
            },
            phone_num: {
                validators: {
                    digits: {
                        message: 'Please enter a valid phone'
                    }
                }
            },
            timezone: {
                validators: {
                    notEmpty: {
                        message: 'The Timezone is required and can\'t be empty'
                    }
                }
            },
            birthday: {
                validators: {
                    notEmpty: {
                        message: 'The Birthday is required and can\'t be empty'
                    },
                    date: {
                        message: 'Please enter a valid date',
                        format: 'MM/DD/YYYY'
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
                        message: 'The Category is required and can\'t be empty'
                    },
                }
            },
            txtPrice: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The value can contain only digits'
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
                        message: 'The Approve Date is required and can\'t be empty'
                    },
                    date: {
                        message: 'Please enter a valid date',
                        format: 'MM/DD/YYYY'
                    }
                }
            },
            txtPaymentDate: {
                validators: {
                    notEmpty: {
                        message: 'The Payment Date is required and can\'t be empty'
                    },
                    date: {
                        message: 'Please enter a valid date',
                        format: 'MM/DD/YYYY'
                    }
                }
            },
            txtTitle: {
                validators: {
                    notEmpty: {
                        message: 'The Title is required and can\'t be empty'
                    }
                }
            },
            txtDescription: {
                validators: {
                    notEmpty: {
                        message: 'The Description is required and can\'t be empty'
                    }
                }
            },
            txtReason: {
                validators: {
                    notEmpty: {
                        message: 'The Reason is required and can\'t be empty'
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
    $('#birthday')
        .on('changeDate show', function(e) {
            $('#editProfile')
                .bootstrapValidator('updateStatus', 'birthday', 'NOT_VALIDATED')
                .bootstrapValidator('validateField', 'birthday');
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