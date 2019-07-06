jQuery(function () {
    jQuery('.jquery-validate-loginform').validate({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            'username': {
                required: true,
                minlength: 3
            },
            'password': {
                required: true,
                minlength: 6
            }
        },
        messages: {
            'username': {
                required: '请输入用户名',
                minlength: '用户名至少3个字符'
            },
            'password': {
                required: '请输入密码',
                minlength: '密码至少6位'
            }
        }
    });

});