@extends('layouts.default')
@section('title')
    Candidate Exams
@endsection

@section('content')

    <style>
        #example1_filter,#example1_paginate {
            float: right;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small> Candidate Exams </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('userExam')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Candidate Exams</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">
            <div >

                @include('alertNotifications/alertNotifications')

                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Candidate Exams</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Exam Title</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                     <tr>
                                     <td>1</td>
                                    <td>English Exam</td>
                                    <td>{{$englishStatus}}</td>
                                     @if($englishStatus == "Can Exam")
                                    <td><a href="{{url('setEnglishExam')}}"><button class="btn btn-primary">Start Exam</button></a></td>
                                         @else
                                         <td></td>
                                     @endif

                                     </tr>
                                     <tr>
                                         <td>2</td>
                                         <td>Personal Exam</td>
                                         <td>{{$personalStatus}}</td>
                                         @if($personalStatus == "Can Exam")
                                             <td><a href="{{url('setPersonalExam')}}"><button class="btn btn-primary">Start Exam</button></a></td>
                                             @else
                                             <td></td>
                                         @endif
                                     </tr>

                                     <tr>
                                         <td>3</td>
                                         <td>Microsoft Office Exam</td>
                                         <td>{{$msStatus}}</td>
                                         @if($msStatus == "Can Exam")
                                             <td><a href="{{url('setMsExam')}}"><button class="btn btn-primary">Start Exam</button></a></td>
                                             @else
                                             <td></td>
                                         @endif
                                     </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->




    </div>

@section('js')

    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- DataTables -->


    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : false,
                'lengthChange': true,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>

    <script>



    </script>
@endsection
@endsection