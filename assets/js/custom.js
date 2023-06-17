$(document).ready(function () {

    alertify.set('notifier','position', 'top-right');

    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();

        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();

        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    
    $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                'product_id': product_id,
                'product_qty' : product_qty,
                'scope':'addtocart'
            },
            success: function (response) {
                //swal(response.status);
                alertify.success(response);
            }
        });

    });
    
    $(document).on('click', '.removeFromCartBtn', function (e) {
        e.preventDefault();

        var cart_id = $(this).closest('.product_data').find('.cart_id').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                'cart_id':cart_id,
                'scope':'removefromcart'
            },
            success: function (response) {
                alertify.success(response);
                $("#usercart").load(location.href + " #cart");

            }
        });
    });


    $(document).on('click', '.changeQuantity', function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'product_id' : product_id,
            'product_qty' : product_qty,
            'scope':'updatequantity'
        }
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: data,
            success: function (response) {
                $("#usercart").load(location.href + " #cart");
            }
        });

    });
    
  
});
