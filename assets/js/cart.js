var viewportWidth = $(window).width();

function addToCart(This) {

    var productId = This.closest('div').parent().parent().attr('id');

    var productName = This.closest('div').parent().find('.prodName').html();

    var productPrice = This.closest('div').find('.prodPrice').html();
    
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
                flyToElement(This, $('.cartIcon'));
            } else {
                flyToElement(This, $('.minKurv'));
            }

            const dvProductBlock = This.closest('div').parent().parent();

            updateCounts(dvProductBlock, 'plus');

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
}
function updateCounts(This, action) {
    This.css('background-color', '#b8edb840');

    let qty = This.find('.spanQty').html();

    if (qty != '') {
        if (action === 'plus') {
            qty = parseInt(qty) + 1;
        } else {
            qty = parseInt(qty) - 1;
        }
    } else {
        qty = 1;

    }

    if (qty > 0) {
        This.find('.spanQty').html(qty + ' x ');
    } else {
        This.find('.spanQty').html('');
        This.css('background-color', '#ffffffff');
    }


    let catCount = This.parent().parent().find('.catCount').html();

    if (catCount != '') {
        if (action === 'plus')
            catCount = parseInt(catCount) + 1;
        else {
            catCount = parseInt(catCount) - 1;
        }

    } else {
        catCount = 1;
    }

    if (catCount === 0) {
        This.parent().parent().find('.catCount').html('');
        This.parent().parent().find('.catCount').css('display', 'none');
    } else {
        This.parent().parent().find('.catCount').css('display', 'inline-block');

        This.parent().parent().find('.catCount').html(catCount + ' x');
    }


}
function plusCart(This) {

    var productId = This.closest('div').parent('div').attr('id');

    var productData = {

        productId: productId,

        action: 'increment'
    };

    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'cart/',

        data: productData,

        success: (response) => {

            $('.myCart').html('');

            $('.myCart').html(response);

            var count = parseInt($('#lblCartCount').text()) + 1;

            $('#lblCartCount').text(count);

            let productId = This.closest('div').parent('div').attr('id');

            const dvProductBlock = $("#" + productId);

            updateCounts(dvProductBlock, 'plus');

            //let qty = $("#" + productId).find('.spanQty').html();

            //qty = parseInt(qty) + 1;

            //$("#" + productId).find('.spanQty').html(qty + ' x ');

        }
    });
}



function minusCart(This) {

    var productId = This.closest('div').parent('div').attr('id');

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

            let productId = This.closest('div').parent('div').attr('id');

            const dvProductBlock = $("#" + productId);

            updateCounts(dvProductBlock, 'minus');

            /*let qty = $("#" + productId).find('.spanQty').html();

            qty = parseInt(qty) - 1;

            if (qty == 0) {
                $("#" + productId).find('.spanQty').html('');
                $("#" + productId).css('background-color', '#ffffffff');
            } else {
                $("#" + productId).find('.spanQty').html(qty + ' x ');
            }
            */


        }
    });
}

function processCheckout() {
    var formData = {
        fname: $('#chkFname').val(),

        lname: $('#chkLname').val(),

        mobile: $('#chkPhone').val(),

        email: $('#chkEmail').val(),

        comments: $('#chkComments').val()
    }

    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'checkout/processOrder',

        data: formData,

        success: (response) => {

            if(response) {
                window.location.href = CI_ROOT + 'checkout/generateToken';
            } else {
                alert('Der er en fejl, prøv venligst senere');
            }

        }
    });
}

function orderProcess(This) {
    var orderId = This.attr('data-id');

    var data = {
        orderId: orderId
    }

    $.ajax({
        type: 'POST',

        url: CI_ROOT + 'history/orderDetail',

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
}

function showCart() {
    document.querySelector('.content').scrollIntoView({ behavior: 'smooth' });

    if ($('#cart').hasClass("hideCart")) {

        $('#cart').removeClass('hideCart');
    }

    $.ajax({

        async: false,
        type: 'GET',

        url: CI_ROOT + 'cart/getCart',

        success: (response) => {


            $("#cart").fadeIn(3000, function () {
                // Animation complete
                $('#cart').addClass('showCart');
                $('.myCart').html('');

                $('.myCart').html(response);
            });


        }
    });
}

function flyToElement(flyer, flyingTo) {
    var $func = $(this);
    var divider = 3;
    var flyerClone = $(flyer).clone();
    $(flyerClone).css({ position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000 });
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width() / divider) / 2;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height() / divider) / 2;

    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyer).width() / divider,
        height: $(flyer).height() / divider
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