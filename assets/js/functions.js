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

        logOut(); // Function defination resides in user.js

    });

    $('form').submit(function (e) {

        e.preventDefault();

        var formId = $(this).attr('id');

        if (formId === 'formLogin') {
            
            logIn(); // Function defination resides in user.js
            
        } else {
            
            if($('.chkPolicyCheckbox').is(':checked')) {                
            
                signUp(); // Function defination resides in user.js
            
            } else {
            
                $('#spnError').html('Accept venligst vores Privatlivspolitik og Handelsbetingelser inden du fortsater');
            
            }
            
        }

    });
    // Signup function called on signup form submit



    // Add to cart
    $(document).on('click', '.addToCart', function (e) {

        addToCart($(this)); // Function defination resides in cart.js

    });



    $(document).on('click', '.plusCart', function (e) {

        plusCart($(this)); // Function defination resides in cart.js

    });

    $(document).on('click', '.minusCart', function (e) {

        minusCart($(this)); //Function defination resides in cart.js

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
            $('#myLoginModal').modal('show'); // if user is not loged in then open login modal.
            return false;
        }

    });

    // This is checout button in checkout page.
    // Customer's address will be operated depending on different checks like, save in case of new customer, updated if customer wwants different delivery address or no change if customer wants to deliver on already given address
    $(document).on('submit', '#chkOutForm', function (e) {

        e.preventDefault();
        
        $.ajax({           
            type: 'POST',

            url: CI_ROOT + 'checkout/isStoreOpen',

            success: (response) => {

                if (response) {

                    checkout();

                } else {
                    alert('Vi lukker nu, prøv venligst i vores åbningstider. Tak!')
                    return false;
                }

            }
        });
    });
    
    $(document).on('click', '.chkPolicyCheckbox', function (e) {
        if($(this).is(':checked')) {
            //$('#chklblpolicy').html('Accept venligst vores Privatlivspolitik og Handelsbetingelser inden du fortsater');
            $('.chklblpolicy').css('display','none'); 
            $('#spnError').css('display', 'none');           
        } 
    });
    

    $(document).on('click', '#lnkForgotPassword', function (e) {
        $('#myLoginModal').modal('hide');
        $('#forgotPasswordModal').modal('show');
    });

    $(document).on('submit', '#formForgotPassword', function (e) {

        e.preventDefault();
        forgotPassword(); // function resides in user.js

    });

    $(document).on('click', '#btnForgotPasswordConfirm', function (e) {

        $('#lblForgotPasswordError').html('');

        $('#lblForgotPasswordError').css('display', 'none');

        $('#emailForgotPassword').val('');

        $(this).css('display', 'none');
    });


    $(document).on('submit', '#formResetPassword', function (e) {

        e.preventDefault();

        resetPassword(); // Function resides in user.js       

    });

    $(document).on('submit', '#formProfile', function (e) {

        editProfile(); // Function resides in user.js

    });
    $(document).on('click', '.btnPrintOrder', function (e) {
        window.print();
    });
    $(document).on('click', '.orderProcess', function (e) {

        orderProcess($(this)); // Function resides in cart.js

    });

    $(document).on('click', '.cartIcon', function (e) {

        showCart(); // Function definition resides in cart.js

    });

    $(document).on('click', '.closeCart', function (e) {

        if ($('#cart').hasClass("showCart")) {
            $('#cart').removeClass('showCart');
        }
        $('#cart').hide("slow");
    });

    $(document).on('submit', '#formChangePassword', function (e) {

        e.preventDefault();

        changePassword(); // function definition resides in user.js        

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

function checkout() {

    if ($('#dvPrivacy').length) {
        if ($('.chkPolicyCheckbox').is(':checked')) {
            processCheckout(); // Function defination resides in cart.js
        } else {
            $('.chklblpolicy').css('display', 'block');
            $('.chklblpolicy').html('Accept venligst vores Privatlivspolitik og Handelsbetingelser inden du fortsater');
        }
    } else {
        processCheckout(); // Function defination resides in cart.js
    }


}

$(window).on('load', function () {

    $(".mainAccordion").each(function () {
        let catCount = 0;
        $(this).find(".productBlock").each(function () {
            let qty = $(this).find('.spanQty').html();
            if (qty != '') {
                catCount += parseInt(qty);
            }
        });

        if (catCount > 0) {
            $(this).find('.catCount').css('display', 'inline-block');

            $(this).find('.catCount').html(catCount + ' x');
        }

    });

});
