<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->


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
        @if(session('success-status'))
            <div class="alert alert-success" role="alert">
                {{session('success-status')}}
            </div>
        @endif
        @if(session('error-status'))
            <div class="alert alert-success" role="alert">
                {{session('error-status')}}
            </div>
        @endif

        <form class="contact100-form validate-form" action="{{route('user-form.add')}}" method="POST">
            @csrf

				<span class="contact100-form-title">
					User Form
				</span>

            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Your Name</span>
                <input class="input100" type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div>
                @error('name')
                <span class="error" >{{$message}}</span>
                @enderror
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                <span class="label-input100">Email</span>
                <input class="input100" type="email" name="email" placeholder="Enter your email addess" required>

            </div>
            <div>
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Valid pincode is required: 123456">
                <span class="label-input100">Pincode</span>
                <input class="input100" type="number" name="pincode" placeholder="Enter your pincode" required>
            </div>
            <div>
                @error('pincode')
                <span class="error">{{$message}}</span>
                @enderror
            </div>


            <div class="container-contact100-form-btn">
                <div class="wrap-contact100-form-btn">
                    <div class="contact100-form-bgbtn"></div>
                    <button type="submit" class="contact100-form-btn">
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
</body>
</html>
