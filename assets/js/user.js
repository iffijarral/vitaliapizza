function logIn() {
    var email = $('#email').val();

    var password = $('#password').val();

    var url = $('#formLogin').attr('action');

    var isCheckout = $('#isCheckout').val();

    var formData = {

        email: email,

        password: password,

        isCheckout: isCheckout,

        action: 'login'
    };


    $.ajax({
        type: 'POST',

        url: url,

        data: formData,

        success: function (response) {

            if (response === '1') {

                location.reload(true);

            } else if (response === '2') {

                const url = CI_ROOT + 'checkout';

                window.location.href = url;
            } else {

                $('.error').html('Forkert email eller adgangskode');

            }
        }
    });
}

function signUp() {
    var fname = $('#fname').val();

    var lname = $('#lname').val();

    var mobile = $('#mobile').val();

    var email = $('#emailSignup').val();

    var password = $('#passwordSignup').val();

    var rePassword = $('#repPassword').val();

    if (password !== rePassword) {

        $('.error').html('Adgangskode og gentag adgangskode er ikke samme ');

        return false;
    }

    var url = $('#formSignup').attr('action');

    var formData = {
        fname: fname,

        lname: lname,

        mobile: mobile,

        email: email,

        password: password,

        action: 'signup'
    };

    $.ajax({
        type: 'POST',

        url: url,

        data: formData,

        success: function (response) {

            if (response === '1') {

                location.reload(true);

            } else if (response === '2') {

                $('#spnError').html('Der findes allerede den angivne e-mail');

            } else {

                $('#spnError').html('Der kom en fejl, prøv igen senere');

            }
        }
    });
}

function logOut() {
    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'user/logOut',

        success: function (response) {

            if (response === '1') {

                window.location.href = CI_ROOT;

            } else {

                alert('An error occored');

            }
        }
    });
}

function editProfile() {
    var formData = {

        fname: $('#fnameProfile').val(),

        lname: $('#lnameProfile').val(),

        mobile: $('#mobileno').val(),

        email: $('#emailProfile').val()

    }
    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'profile/editProfile',

        data: formData,

        success: (response) => {

            if (response) {
                $('#lblProfile').css('display', 'block');
                $('#lblProfile').html('Ændringer gemt');
            }


        }
    });
}

function resetPassword() {
    var pas1 = $('#newPassword').val();

    var pas2 = $('#reNewPassword').val();

    if ($.trim(pas1) === $.trim(pas2)) {

        pas2 = 'abc'; // its nothing, just to continue execution. 
    } else {
        $('#lblResetPassword').css('display', 'block');
        $('#lblResetPassword').html('Nykode og gentagekode er ikke samme');
        return false;
    }

    var formData = {
        password: pas1,
        action: 'resetPassword'
    }

    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'user/',

        data: formData,

        success: (response) => {

            if (response) {

                $('#lblResetPassword').css('display', 'block');

                $('#lblResetPassword').html(response);

                $('#newPassword').val('');

                $('#reNewPassword').val('');

            }


        }
    });
}

function forgotPassword() {
    var email = $.trim($('#emailForgotPassword').val());

    var formData = {
        email: email,
        action: 'forgotPassword'
    }

    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'user/',

        data: formData,

        success: (response) => {

            $('#lblForgotPasswordError').css('display', 'block');
            $('#btnForgotPasswordConfirm').css('display', 'block');

            $('#lblForgotPasswordError').html(response);

        }
    });
}

function changePassword() {
    var oldPassword = $('#oldPassword').val();
    var newPassword = $('#newPassword').val();
    var reNewpassword = $('#reNewPassword').val();

    if ($.trim(newPassword) === $.trim(reNewpassword)) {
        var a = 'abc'; // this does nothing. just to continue.
    } else {
        $('#lblChangePassword').css('display', 'block');
        $('#lblChangePassword').html('Nykode og gentagekode er ikke samme');
        return false;
    }

    var formData = {
        oldPassword: oldPassword,
        password: newPassword,
        action: 'editPassword'
    }
    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'profile/editPassword',

        data: formData,

        success: (response) => {


            $('#lblChangePassword').css('display', 'block');

            $('#lblChangePassword').html(response);

            $('#oldPassword').val('');

            $('#newPassword').val('');

            $('#reNewPassword').val('');

            $('#oldPassword').focus();
        }
    });
}