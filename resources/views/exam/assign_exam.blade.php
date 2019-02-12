@extends('layouts.default')
@section('title')
    Assign Exams
@endsection

@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small> Assign Exams </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Assign Exams</li>
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>English Exam</th>
                                    <th>Personal Exam</th>
                                    <th>M.s Office Exam</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        @if(Helper::assignEnglishExamChecker($user->id) == "not have exam")
                                        <td><a href="{{url('assignEnglishExam/'.$user->id)}}"><button class="btn btn-primary">Add Exam</button></a></td>
                                            @else
                                            <td></td>
                                        @endif
                                        @if(Helper::assignPersonalExamChecker($user->id) == "not have exam")
                                            <td><a href="{{url('assignPersonalExam/'.$user->id)}}"><button class="btn btn-primary">Add Exam</button></a></td>
                                        @else
                                            <td></td>
                                        @endif

                                        @if(Helper::assignMsExamChecker($user->id) == "not have exam")
                                            <td><a href="{{url('assignMsExam/'.$user->id)}}"><button class="btn btn-primary">Add Exam</button></a></td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>

                                    @endforeach

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
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'order': [[ 0, 'desc' ]]
            })
        })
    </script>

    <script>



    </script>
@endsection
@endsection