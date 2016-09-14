$(document).ready(function() {
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
                        min: 6,
                        message: 'Message must be more than 6 characters long'
                    }
                }
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: "POST",
                url:   "add.json",
                dataType: 'text',
                async:false,
                data: $("form").serialize(),
                success: function (data) {
                    // ev.stopPropagation();
                    // removeModalHandler();
                    $("#md-add-department").removeClass("md-show");
                    $('#createDepartment').trigger('reset');
                    // window.setTimeout(function () {$("#md-add-department").remove();},500);
                    return true;

                }
                    // ,
                    // error: function (xhr, ajaxOptions, thrownError) {
                    //     alert(xhr.status);
                    //     alert(thrownError);
                    //     alert(xhr.responseText);
                    // }
            });
            return false; // required to block normal submit since you used ajax
        },
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
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
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
s                            }
                        });
                    }else {
                        if(returnedData.result.mode === 1)
                        {
                            $("#email").parent().switchClass("has-success","has-error");
                            $("#email").focus();
                        }else if(returnedData.result.mode === 2){
                            $("#username").parent().switchClass("has-success","has-error");
                            $("#email").focus();
                        }
                        else {
                        //    do something
                        }
                        $( ".alertMessage" ).replaceWith( returnedData.content );
                    }

                }
            });
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;

        },
    });

    $('#editProfile').bootstrapValidator({
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
                        min: 6,
                        message: 'Message must be more than 6 characters long'
                    }
                }
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url:   "add",
                data: $(form).serialize(),
                success: function () {
                    // ev.stopPropagation();
                    // removeModalHandler();
                    $("#md-add-department").removeClass("md-show");
                    // $(form).data('formValidation').resetForm();
                    $('#createDepartment').trigger('reset');
                    // window.setTimeout(function () {$("#md-add-department").remove();},500);
                    return true;

                }
                // ,
                // error: function (xhr, ajaxOptions, thrownError) {
                //     alert(xhr.status);
                //     alert(thrownError);
                //     alert(xhr.responseText);
                // }
            });
            return false; // required to block normal submit since you used ajax
        },
    });


    $('#frRequest').bootstrapValidator({
        fields: {
            sltCategory: {
                validators: {
                    notEmpty: {
                        message: 'The category is required and can\'t be empty'
                    },
                }
            },
            txtPrice: {
                validators: {
                    notEmpty: {
                        message: 'The category is required and can\'t be empty'
                    },
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
                        min: 6,
                        message: 'Message must be more than 6 characters long'
                    }
                }
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url:   "add",
                data: $(form).serialize(),
                success: function () {
                    // ev.stopPropagation();
                    // removeModalHandler();
                    $("#md-add-department").removeClass("md-show");
                    // $(form).data('formValidation').resetForm();
                    $('#createDepartment').trigger('reset');
                    // window.setTimeout(function () {$("#md-add-department").remove();},500);
                    return true;

                }
                // ,
                // error: function (xhr, ajaxOptions, thrownError) {
                //     alert(xhr.status);
                //     alert(thrownError);
                //     alert(xhr.responseText);
                // }
            });
            return false; // required to block normal submit since you used ajax
        },
    });


});