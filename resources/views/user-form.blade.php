<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
    <!--===============================================================================================-->


    <style>
        .error {
            color: red;
            position: relative;
            top: -22px
        }
    </style>
</head>
<body>

<div class="container-contact100">
    <div class="wrap-contact100">
        {{--@if(session('success-status'))--}}
            <div class="alert alert-success" role="alert" id="success-div" style="display: none">
               <span id="success-message">{{session('success-status')}}</span>
            </div>
        {{--@endif--}}
        {{--@if(session('error-status'))--}}
            <div class="alert alert-success" role="alert" id="error-div" style="display: none">
                <span id="error-message">{{session('error-status')}}</span>
            </div>
        {{--@endif--}}

        <form class="contact100-form validate-form" action="{{--{{route('user-form.add')}}--}}" method="POST" id="user-form">
            @csrf

				<span class="contact100-form-title">
					User Form
				</span>

            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Your Name</span>
                <input class="input100" type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div>
                {{--@error('name')
                <span class="error" >{{$message}}</span>
                @enderror--}}
                <span class="error" id="name"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                <span class="label-input100">Email</span>
                <input class="input100" type="email" name="email" placeholder="Enter your email addess" required>

            </div>
            <div>
                {{--@error('email')
                <span class="error">{{$message}}</span>
                @enderror--}}
                <span class="error" id="email"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Valid pincode is required: 123456">
                <span class="label-input100">Pincode</span>
                <input class="input100" type="number" name="pincode" placeholder="Enter your pincode" required>
            </div>
            <div>
                {{--@error('pincode')
                <span class="error">{{$message}}</span>
                @enderror--}}
                <span class="error" id="pincode"></span>
            </div>


            <div class="container-contact100-form-btn">
                <div class="wrap-contact100-form-btn">
                    <div class="contact100-form-bgbtn"></div>
                    <button type="submit" class="contact100-form-btn" id="submit">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    $('#user-form').validate({

        showErrors:function(error, element) {
            $.each(error,function (key, value) {
               $('#'+key).text(value)
            })
        },
        rules: {
            name : {
                required: true,
            },
            email:{
                required: true,
                email: true
            },
            pincode:{
                required: true,
                maxlength: 6,
                minlength:6
            }
        },
        submitHandler: function () {
            formSubmit();
        }
    })

    function formSubmit() {

        $('#submit').html("<span>\n" +
            "Please Wait" +
            "<i class='fa fa-spinner fa-spin' aria-hidden=\"true\"></i>\n" +
            "</span>");


        $.ajax({
            type: "POST",
            url: "{{route('api.form')}}",
            data: $('#user-form').serialize(),
            success: function (response) {
                button();
                resetError();

                $('#user-form').trigger("reset");
                if (response.status === 1) {

                    $('#user-form').trigger("reset");

                    $('#success-div').show();
                    $('#success-message').text(response.message);
                }

            },
            error: function (response) {

                resetError();
                button();
                /*$('#error-div').show();
                $('#success-message').text(response.message);*/

                //for validation
                var validation = JSON.parse(response.responseText);
                if (response.status == 422) {
                    $.each(validation.errors, function (key, val) {
                        $('#' + key).text(val);

                    });
                }


            }


        });
    }


    function button() {
        $('#submit').html("<span>\n" +
            "Submit" +
            "<i class='fa fa-long-arrow-right m-l-7' aria-hidden=\"true\"></i>\n" +
            "</span>")

    }

    function resetError() {
        $('#name').text("");
        $('#email').text("");
        $('#pincode').text("");
    }

</script>

</body>
</html>
