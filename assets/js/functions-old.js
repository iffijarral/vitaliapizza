$(document).ready(function () {
    
    var viewportWidth = $(window).width();

    if (viewportWidth <= 800) {

        $('#cart').addClass('hideCart');

        $('header').removeClass('container');
    }

    $(document).on('click', '#btnLogin', function (e) {
        $('#lnkToCheckout').css('display', 'none');
        $('#myLoginModal').modal('show');

    });

    $(document).on('click', '#btnLogOut', function (e) {

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


    });

    $('form').submit(function (e) {

        e.preventDefault();

        var formId = $(this).attr('id');

        if (formId === 'formLogin') {
            logIn();
        } else {

            signUp();
        }

    });
    // Signup function called on signup form submit
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

                    $('.error').html('Der findes allerede den angivne e-mail');

                } else {

                    $('.error').html('Der kom en fejl, prøv igen senere');

                }
            }
        });
    }
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

    // Add to cart
    $(document).on('click', '.addToCart', function (e) {

        var productId = $(this).closest('div').parent().attr('id');

        var productName = $(this).closest('div').parent().find('.prodName').html();

        var productPrice = $(this).closest('div').find('.prodPrice').html();

        var productData = {

            productId: productId,

            productName: productName,

            productPrice: productPrice,

            productQty: 1,

            action: 'addToCart'

        };

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'cart/',

            data: productData,

            success: (response) => {
                
                if (viewportWidth <= 800) {
                    flyToElement($(this), $('.cartIcon'));
                } else {
                    flyToElement($(this), $('.minKurv'));
                }
                setTimeout(function () {

                    var count = parseInt($('#lblCartCount').text()) + 1;

                    $('#lblCartCount').text(count);

                    if (viewportWidth > 800) {
                        $('.myCart').html('');

                        $('.myCart').html(response);
                    }

                }, 1000);

            }
        });

    });


    $(document).on('click', '.plusCart', function (e) {

        var productId = $(this).closest('div').parent('div').attr('id');

        var productData = {

            productId: productId,

            action: 'increment'
        };

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'cart/',

            data: productData,

            success: (response) => {

                console.log(response);

                $('.myCart').html('');

                $('.myCart').html(response);

                var count = parseInt($('#lblCartCount').text()) + 1;

                $('#lblCartCount').text(count);
            }
        });

    });

    $(document).on('click', '.minusCart', function (e) {

        var productId = $(this).closest('div').parent('div').attr('id');

        var productData = {

            productId: productId,

            action: 'decrement'

        };

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'cart/',

            data: productData,

            success: (response) => {

                $('.myCart').html('');

                $('.myCart').html(response);

                var count = parseInt($('#lblCartCount').text()) - 1;

                if (count >= 0)
                    $('#lblCartCount').text(count);

            }
        });

    });
    // this checkout button resides in cart.
    $(document).on('click', '#checkout', function (e) {

        getLoginStatus(); // this function sets status value in loginstatus field in cart.

        var loginStatus = $('#loginStatus').val();

        if (loginStatus != '') {

            window.location.href = CI_ROOT + 'checkout/' // if delivery Status is choosen and customer is logged in then proceed to checkout page.

        } else {
            $('#isCheckout').val('checkout');
            $('#lnkToCheckout').css('display', 'block');
            $('#myLoginModal').modal('show'); // if user is not loged in the open login modal.
            return false;
        }

    });

    // This is checout button in checkout page.
    // Customer's address will be operated depending on different checks like, save in case of new customer, updated if customer wwants different delivery address or no change if customer wants to deliver on already given address
    $(document).on('submit', '#chkOutForm', function (e) {

        e.preventDefault();

        var formData = {
            fname: $('#chkFname').val(),

            lname: $('#chkLname').val(),

            mobile: $('#chkPhone').val(),

            email: $('#chkEmail').val(),

            action: 'saveOrder'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'checkout/processOrder',

            data: formData,

            success: (response) => {

                if (response) {
                    $('#Bestilling').modal('show');
                } else {
                    alert('Prøv venligst senere');
                }

            }
        });

    });

    $(document).on('click', '#lnkForgotPassword', function (e) {
        $('#myLoginModal').modal('hide');
        $('#forgotPasswordModal').modal('show');
    });

    $(document).on('submit', '#formForgotPassword', function (e) {
        
        var email = $.trim($('#emailForgotPassword').val());

        var formData = {
            email: email,
            action: 'forgotPassword'
        }
        e.preventDefault();
        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'user/',

            data: formData,

            success: (response) => {

                $('#lblForgotPasswordError').css('display', 'block');
                $('#btnForgotPasswordConfirm').css('display', 'block');

                $('#lblForgotPasswordError').html(response)


            }
        });

    });

    $(document).on('click', '#btnForgotPasswordConfirm', function (e) {

        $('#lblForgotPasswordError').html('');

        $('#lblForgotPasswordError').css('display', 'none');

        $('#emailForgotPassword').val('');

        $(this).css('display', 'none');
    });

    $(document).on('click', '#lnkNewAddress', function (e) {

        e.preventDefault();
        $('#chkSelPostno').prop("disabled", false);
        $('#chkStreet').prop("disabled", false);
        $('#chkStreet').val('');
        $('#chkStreet').focus();
        $('#chkFloor').prop("disabled", false);
        $('#chkFloor').val('');


    });

    $(document).on('submit', '#formResetPassword', function (e) {

        e.preventDefault();

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

    });

    $(document).on('submit', '#formProfile', function (e) {

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

                if(response) {
                    $('#lblProfile').css('display', 'block');
                    $('#lblProfile').html('Ændringer gemt');
                }


            }
        });

    });
    $(document).on('click', '.btnPrintOrder', function (e) {
        window.print();
    });
    $(document).on('click', '.orderProcess', function (e) {

        var orderId = $(this).attr('data-id');        

        var data = {
            orderId: orderId            
        }
        
        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'info/orderDetail',

            data: data,

            success: (response) => {

                if (response) {

                    $('#dvOrderDetail').html('');

                    $('#dvOrderDetail').html(response);

                    $('#orderDetailModal').modal('show');
                } else {

                    alert('There came a problem, please try again later');
                }
            }

        });
    });

    $(document).on('click', '.cartIcon', function (e) {

        document.querySelector('.content').scrollIntoView({ behavior: 'smooth' });

        if ($('#cart').hasClass("hideCart")) {

            $('#cart').removeClass('hideCart');
        }
        
        $.ajax({
            
            async: false,
            
            type: 'GET',

            url: CI_ROOT + 'cart/getCart',

            success: (response) => {

                
                $("#cart").fadeIn(2000, function () {
                    // Animation complete
                    $('#cart').addClass('showCart');
                    $('.myCart').html('');

                    $('.myCart').html(response);
                });


            }
        });
        
        
    });

    $(document).on('click', '.closeCart', function (e) {

        if ($('#cart').hasClass("showCart")) {
            $('#cart').removeClass('showCart');
            //$('#cart').addClass('hideCart');
        }
        //$('#cart').addClass('hideCart');
        $('#cart').hide("slow");
    });

    $(document).on('submit', '#formChangePassword', function (e) {

        e.preventDefault();

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

    });




    function getLoginStatus() {

        var status = false;

        $.ajax({
            async: false,

            type: 'POST',

            url: CI_ROOT + 'user/getLoginStatus',

            success: (response) => {

                if (response) {

                    $('#loginStatus').val(response);

                }
            }
        });

    }

    

    function getTotal() {
        var total = 0;

        $('.itemPrice').each(function () {

            total += parseInt($(this).text());

        });

        return total;
    }
    var currentdate = new Date();
    var hour = currentdate.getHours();



});

function flyToElement(flyer, flyingTo) {
    var $func = $(this);
    var divider = 3;
    var flyerClone = $(flyer).clone();
    $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
     
    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyer).width()/divider,
        height: $(flyer).height()/divider
    }, 700,
    function () {
        $(flyingTo).fadeOut('fast', function () {
            $(flyingTo).fadeIn('fast', function () {
                $(flyerClone).fadeOut('fast', function () {
                    $(flyerClone).remove();
                });
            });
        });
    });
}