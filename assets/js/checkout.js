
$(document).ready(function () {

    $('.payRazorpayBtn').click(function (e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var phone = $('.phone').val();
        var address = $('.address').val();
        var pincode = $('.pincode').val();
        var user_message = $('.user_message').val();

        if(!firstname)
        {
            fname_error = "First Name is required";
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        }
        else{
            fname_error = "";
            $('#fname_error').html('');
        }

        if(!lastname)
        {
            lname_error = "Last name is required";
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        }
        else{
            lname_error = "";
            $('#lname_error').html('');
        }

        if(!phone)
        {
            phone_error = "Phone is required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }
        else{
            phone_error = "";
            $('#phone_error').html('');
        }

        if(!address)
        {
            address_error = "Address is required";
            $('#address_error').html('');
            $('#address_error').html(address_error);
        }
        else{
            address_error = "";
            $('#address_error').html('');
        }

        if(!pincode)
        {
            pincode_error = "Pincode is required";
            $('#pincode_error').html('');
            $('#pincode_error').html(pincode_error);
        }
        else{
            pincode_error = "";
            $('#pincode_error').html('');
        }

        if(fname_error != '' || lname_error != '' || phone_error != '' || address_error != '' || pincode_error != '')
        {
            return false;
        }
        else
        {

            $.ajax({
                method: "POST",
                url: "functions/handlecheckout.php",
                data: {
                    'scope': "get_total"
                },
                success: function (response) {

                    var options = {
                        "key": "rzp_live_rx6kMHfOw6F5CQ", // Enter the Key ID generated from the Dashboard
                        "amount": response*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": firstname+" "+lastname,
                        "description": "Thank you for choosing us",
                        "image": "https://example.com/your_logo",
                        "handler": function (responsea){
                            $.ajax({
                                method: "POST",
                                url: "functions/handlecheckout.php",
                                data: {
                                    'fname':firstname,
                                    'lname':lastname,
                                    'phone':phone,
                                    'address':address,
                                    'pincode':pincode,
                                    'user_message':user_message,
                                    'payment_mode':"Paid by Razorpay",
                                    'payment_id':responsea.razorpay_payment_id,
                                    'scope': "placeorder"
                                },
                                success: function (responseb) {
                                    var res= JSON.parse(responseb);
                                    swal("",res.message,res.icon).then( (value) => {
                                        if (value) {
                                            window.location.href = "myorders.php"
                                    }
                                });
                                }
                            });
                        },
                        "prefill": {
                            "name": firstname+' '+lastname,
                            "contact": phone
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });
        }
    });

});
