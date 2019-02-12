<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zain Employee|Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
    <![endif]-->
    <style>

        body {
            background: url('{!! asset('images/background.png') !!}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body >



<div class="container ">
    <div style="text-align: center">
    </div>
    <div  style="margin-top:100px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">

        <div style="border: 2px solid white;border-radius: 8px;">
            <div style="display:none"  class="alert alert-danger col-sm-12"></div>

            <form class="form-horizontal" role="form" method="post" action ="{{ route('register') }}">
                <div style="margin-top:4px;margin-left: 5px;margin-right:5px" >
                    @include('alertNotifications/alertNotifications')
                </div>
                {{csrf_field()}}
                <div style="text-align: center;color: white">

                </div>
                <div style="margin-top:10px;margin-left: 3px;margin-right:3px;margin-bottom: -10px " class="form-group">

                    <div style="margin-top: 10px;" class="col-sm-12 controls text-center" >
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"  autofocus placeholder="Full name" >


                    </div>
                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input type="email" name="email" class="form-control" placeholder="Email" required>


                    </div>

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input type="password" name="password" class="form-control" placeholder="Password" >


                    </div>

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input type="password" class="form-control" name="password_confirmation"  placeholder="Retype password">


                    </div>

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <select  name="section" class="form-control select2 " data-placeholder="Select Permission" style="width: 100%;">
                            <option value="" disabled selected>Select Permission</option>

                                <option >Admin</option>
                                <option >Candidate</option>

                        </select>


                    </div>

                </div>
                <br>
                <div style="margin-left: 3px;margin-right:3px" class="form-group">

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input  style="background-color: #DE0184;border-color: #ffffff;" type="submit" value="Register"   class="btn btn-primary btn-block">


                    </div>

                    <div class="col-sm-12 controls text-center " >
                        <p style="margin-top:5px;color: white"></p>
                    </div>
                    <div style="margin-top: 5px;" class="col-sm-12 controls text-center " >
                        <p style="margin-top:-10px;color: white">If have problem in Sing in ,Please Contact System Administration</p>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
</div>
</div>

<div style="background-color: black" class="navbar navbar-fixed-bottom text-center"><span style="color: #2ab27b"><b>{{date("Y")}} &copy; Zain Iraq</b></span></div>
@section('js')
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script>


        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endsection
</body>
</html>
