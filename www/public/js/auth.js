$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('button#showPassBtn').click(function () {
        let input = $(`input[name="password"]`);

        if(input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $('button#showPassConfirmBtn').click(function () {
        let input = $(`input[name="password_confirm"]`);

        if(input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});