<header class="main-header">
    <!-- Logo -->

    @if(Auth::user()->permission == "Admin")
    <a href="{{url('/')}}" class="logo">
        @else
            <a href="{{url('userExam')}}" class="logo">
                @endif
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Z</b>IQ</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Zain</b>Iraq</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->


                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs">Welcome: <b>{{\Auth::user()->email}}</b></span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="user-footer">

                            <div style="text-align: center" >
                                <a href="{{url('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
            </div>
            <div class="pull-left info">
                <p><b></b></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @if(Auth::user()->permission == "Admin")
            <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-language"></i> <span>English Questions Section</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Add English Questions</span>
                                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('/addEnglishMainQuestion')}}"><i class="fa fa-circle-o"></i> Add Main Questions</a></li>
                                <li><a href="{{url('/addEnglishSubQuestion')}}"><i class="fa fa-circle-o"></i> Add Sub Questions</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i>
                                <span>Manage English Questions</span>
                                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('/manageGrammarQuestion')}}"><i class="fa fa-circle-o text-red"></i>Manage Grammar Questions</a></li>
                                <li><a href="{{url('/manageParagraphQuestion')}}"><i class="fa fa-circle-o text-yellow"></i>Manage Paragraph Questions</a></li>
                                <li><a href="{{url('/manageAudioQuestion')}}"><i class="fa fa-circle-o text-aqua"></i>Manage Audio Questions</a></li>
                            </ul>
                        </li>
                        {{--<li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Add English Questions</a></li>--}}
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-product-hunt"></i> <span>Personal Questions Section</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="{{url('addPersonalQuestion')}}"><i class=" fa fa-files-o"></i> <span>Add Personal Question </span></a></li>
                        <li><a href="{{url('managePersonalQuestion')}}"><i class="fa fa-files-o"></i> <span>Manage Personal Question</span></a></li>
                    </ul>
                </li>

                <li class=" treeview">
                    <a href="#">
                        <i class="fa fa-windows"></i> <span>Microsoft  Questions Section</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="{{url('addMsQuestion')}}"><i class=" fa fa-files-o"></i> <span>Add Microsoft Office Question </span></a></li>
                        <li><a href="{{url('manageMsQuestion')}}"><i class="fa fa-files-o"></i> <span>Manage Microsoft Question</span></a></li>
                    </ul>
                </li>
                <li><a href="{{url('assignExam')}}"><i class="fa fa-files-o"></i> <span>Assign Exam </span></a></li>
                <li><a href="{{url('showCandidates')}}"><i class="fa fa-book"></i> <span>Manage Candidate</span></a></li>
            <li><a href="{{url('register')}}"><i class="fa fa-users"></i> <span>Register</span></a></li>
                <li><a href="{{url('analysis')}}"><i class="fa fa-language"></i> <span>Analysis</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>