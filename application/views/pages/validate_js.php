<script>
    //Login Validation

    $("#login_form").validate({
        // Specify the validation rules
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        // Specify the validation error messages
        messages: {
            username: "Please enter a username",
            password: {
                required: "Please provide a password",
            },
        },
        submitHandler: function(form) {
            $(".alert").hide();
            form.submit();
        }
    });

    $("#signup_form").validate({
        // Specify the validation rules
        rules: {
            email: {
                required: true,
                email: true,
            },
            user_name: {
                required: true,
            },
            password: {
                required: true,
            },
            cpassword: {
                required: true,
                equalTo: "#password",
            },
            company: {
                required: true,
            },
        },
        // Specify the validation error messages
        messages: {
            password: {
                required: "Please provide a password",
            },
            cpassword: {
                required: "Please provide a password",
                equalTo: "Please enter the same password as left",
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: '<?php echo base_url(); ?>user_account/signUp',
                type: 'POST',
                data: $("#signup_form").serialize(),
                beforeSend: function() {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();
                    var json = $.parseJSON(data);
                    if (json.status) {
                        swal({
                            title: "Success",
                            text: json.message,
                            type: "success"
                        },
                        function() {
                            window.location.href = "";
                        });
                    } else {
                        swal({
                            title: "Oops",
                            text: json.message,
                            type: "error"
                        });

                    }


                },
                error: function() {
                    swal("Oops!", "error in form submission", "warning")
                    $(".loading").hide();
                }
            });
        }
    });


    $("#reset_form").validate({
        // Specify the validation rules
        rules: {
            password: {
                required: true,
            },
            cpassword: {
                required: true,
                equalTo: "#password",
            }


        },
        // Specify the validation error messages
        messages: {
            password: {
                required: "Please provide a password",
            },
            cpassword: {
                required: "Please provide a password",
                equalTo: "Please enter the same password as above",
            }
        },
        submitHandler: function(form) {
            $(".alert").hide();
            form.submit();
        }
    });
</script>