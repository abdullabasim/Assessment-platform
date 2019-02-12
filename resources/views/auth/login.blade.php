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
    <div  style="margin-top:180px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">


        <div style="border: 2px solid white;border-radius: 8px;">
            <div style="display:none"  class="alert alert-danger col-sm-12"></div>

            <form class="form-horizontal" role="form" method="post" action ="{{ route('login') }}">
                <div style="margin-top:4px;margin-left: 5px;margin-right:5px" >
                    @include('alertNotifications/alertNotifications')
                </div>
                {{csrf_field()}}
                @csrf
                <div style="text-align: center;color: white">


                </div>
                <div style="margin-top:10px;margin-left: 3px;margin-right:3px;margin-bottom: -10px " class="form-group">

                    <div style="margin-top: 10px;" class="col-sm-12 controls text-center" >
                        <input  id="email" type="text" class="form-control" name="email" placeholder="Enter Your Email Address" value="{{ old('email') }}" required autofocus>


                    </div>

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Your Password" >


                    </div>

                </div>
                <br>
                <div style="margin-left: 3px;margin-right:3px" class="form-group">

                    <div style="margin-top: 20px;" class="col-sm-12 controls text-center" >
                        <input  style="background-color: #DE0184;border-color: #ffffff;" type="submit" value="Login"   class="btn btn-primary btn-block">


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


</body>
</html>
