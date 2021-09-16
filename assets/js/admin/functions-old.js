$(document).ready(function () {

    $(document).on('click', '.btnDeleteCategory', function (e) {

        var categoryId = $(this).closest('tr').attr('id');

        var confirm = window.confirm("Are you sure, you want to delete !");

        if (!confirm) {

            return false;
        }

        var data = {
            id: categoryId,

            action: 'delete'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/category/',

            data: data,

            success: (response) => {

                if (response) {

                    $(this).parents('tr').detach();
                }
            }
        });

    });


    $(document).on('click', '#btnCatSave', function (e) {
        e.preventDefault();

        var catName = $('#catName').val();

        if (catName === '') {

            alert('Please give a valid Category Name.');

            $('#catName').focus();

            return false;
        }

        var data = {
            catName: catName,

            action: 'save'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/category/',

            data: data,

            success: (response) => {

                if (response) {

                    var category = jQuery.parseJSON(response);

                    $('#addCat').modal('toggle');

                    var tr = "<tr id='" + category.id + "'>";
                    tr += "<td class='catData' contenteditable='true' colName='name' prevVal='" + category.name + "'> " + category.name + " </td>";
                    tr += "<td><button class='btn btn-success btnUpdateCategory'>UPDATE</button></td>";
                    tr += "<td><button class='btn btn-danger btnDeleteCategory'>DELETE</button></td>";

                    $('#tableCategory tbody').append(tr);

                    $('#catName').val('');

                }
            }
        });

    });

    $(document).on('click', '.btnUpdateCategory', function (e) {

        var catId = $(this).closest('tr').attr('id');

        var catName = $(this).closest('tr').find('.catData').text();

        var preVal = $(this).closest('tr').find('td:first').attr('prevVal');

        if ($.trim(catName) === $.trim(preVal)) {

            return false;
        }

        var data = {

            id: catId,

            catName: catName,

            action: 'update'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/category/',

            data: data,

            success: (response) => {

                if (response) {
                    alert('Record updated successfully');
                } else {

                    alert('There came a problem, please try again later');
                }
            }
        });
    });

    $(document).on('click', '.orderProcess', function (e) {

        var orderId = $(this).attr('data-id');
        var action = $(this).attr('action');

        var data = {
            orderId: orderId,

            action: action
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/order/',

            data: data,

            success: (response) => {

                if (response) {

                    if (response === 'orderUpdated') {

                        $(this).parents('tr').detach();

                        var rowCount = $("#tableOrders > tbody").children().length;

                        if (rowCount < 1) {
                            
                            var tr = "<tr>";
                            tr += "<td colspan='4' style='text-align: center'> No order available </td>";
                            tr += "</tr>";

                            $('#tableOrders tbody').append(tr);

                        }

                    } else {
                        $('#dvOrderDetail').html('');

                        $('#dvOrderDetail').html(response);

                        $('#orderDetailModal').modal('show');
                    }

                } else {

                    alert('There came a problem, please try again later');
                }
            }

        });
    });

    $(document).on('click', '.btnPrintOrder', function (e) {
        window.print();
        /*var obj = document.createElement("audio");
        obj.src = CI_ROOT+"assets/sounds/bell.ogg"; 
        obj.play(); */
    });
    $(document).on('change', '#selCat', function (e) {

        var catId = $(this).val();

        var data = {
            catId: catId,

            action: 'selectChange'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/product/',

            data: data,

            success: (response) => {

                if (response) {

                    $('#products').html('');

                    $('#products').html(response);

                } else {

                    alert('There came a problem, please try again later');
                }
            }

        });
    });





    $(document).on('click', '#saveProduct', function (e) {

        var catId = $('#modalSelect').val();

        var prodName = $('#prodName').val();

        var prodPrice = $('#prodPrice').val();

        var prodIngredients = $('#prodIngredients').val();

        if (catId === 'Choose Category') {

            alert('Please choose a category');
            return false;
        }

        e.preventDefault();

        var formData = {
            catId: catId,

            prodName: prodName,

            prodPrice: prodPrice,

            prodIngredients: prodIngredients,

            action: 'saveProduct'

        };

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/product/',

            data: formData,

            success: function (response) {

                if (response) {

                    var product = jQuery.parseJSON(response);

                    $('#modalProduct').modal('toggle');

                    window.location.href = CI_ROOT + 'admin/home/product';

                    /*$('#modalSelect').val(product.catid);

                    var tr = "<tr id='" + product.id + "'>";
                    tr += "<td contenteditable='true' class='productName' prevVal='" + product.name + "'> " + product.name + " </td>";
                    tr += "<td contenteditable='true' class='prodIngredients' prevVal='" + product.ingredients + "'> " + product.ingredients + " </td>";
                    tr += "<td contenteditable='true' class='prodPrice' prevVal='" + product.name + "'> " + product.name + " </td>";
                    tr += "<td><button class='btn btn-success btnUpdateProduct prodUpdate'>UPDATE</button></td>";
                    tr += "<td><button class='btn btn-danger btnDeleteProduct prodDelete'>DELETE</button></td>";

                    $('#tableProduct tbody').append(tr);*/

                    /*$('#msg').html('Product Saved Successfully');

                    $('#modalSelect').val('default');

                    $('#prodName').val('');

                    $('#prodPrice').val('');

                    $('#prodIngredients').val('');*/

                } else {

                    alert('There came a problem, please try again later');
                }
            }

        });

    });

    $(document).on('click', '.prodUpdate', function (e) {

        var prodId = $(this).closest('tr').attr('id');

        var prodName = $(this).closest('tr').find('.productName').text();

        var prodIngredients = $(this).closest('tr').find('.prodIngredients').text();

        var prodPrice = $(this).closest('tr').find('.prodPrice').text();

        var data = {

            id: prodId,

            name: prodName,

            ingredients: prodIngredients,

            price: prodPrice,

            action: 'update'

        };

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/product/',

            data: data,

            success: (response) => {

                if (response) {

                    alert('Record Updated Successfully');

                } else {

                    alert('There came a problem, please try again later');
                }
            }

        });

    });

    $(document).on('click', '.prodDelete', function (e) {

        var prodId = $(this).closest('tr').attr('id');

        var confirm = window.confirm("Are you sure, you want to delete !");

        if (!confirm) {

            return false;
        }

        var data = {
            id: prodId,

            action: 'delete'
        }

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/product/',

            data: data,

            success: (response) => {

                if (response) {

                    $(this).parents('tr').detach();

                    var rowCount = $("#tableProduct > tbody").children().length;

                    if (rowCount < 1) {

                        var tr = '<tr>';

                        tr += "<td colspan='5' style='text-align: center'>No record available </td>";
                        tr += "</tr>";

                        $('#tableProduct tbody').append(tr);

                    }
                }
            }
        });

    });

    $(document).on('click', '#adminLogOut', function (e) {

        $.ajax({
            type: 'POST',

            url: CI_ROOT + 'admin/home/logOut',

            success: (response) => {

                if (response) {
                    window.location.href = CI_ROOT;
                } else {
                    alert('An error occured');
                }
            }
        });

    });
});