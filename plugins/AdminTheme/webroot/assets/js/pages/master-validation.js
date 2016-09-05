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


});