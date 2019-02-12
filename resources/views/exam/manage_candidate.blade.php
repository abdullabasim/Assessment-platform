@extends('layouts.default')
@section('title')
    Candidate Exams
@endsection

@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Admin Candidate Exams </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Admin Candidate Exams</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">
            <div >

                @include('alertNotifications/alertNotifications')

                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Admin Candidate Exams</h3>
                            <a style="color: inherit;"><button class="pull-right btn btn-primary adSearch" style="margin-right: 10px; margin-top: 17px;">Export</button></a>

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
                                    <th>English Exam Score</th>
                                    <th>Personal Exam Score</th>
                                    <th>M.s Exam Score</th>
                                    <th>Total Score</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    @if(isset($user->exam->id))
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        @if(! Helper::evaCheckerEnglish($user->exam->id))
                                        <td><a href="{{url('examCandidate/'.$user->exam->id)}}"><button class="btn btn-primary">Show</button></a></td>
                                        @else
                                         <td style="color: red">Not Attend till now</td>
                                        @endif

                                        @if(! Helper::evaCheckerPersonals($user->exam->id))
                                            <td><a href="{{url('examCandidatePersonal/'.$user->exam->id)}}"><button class="btn btn-primary">Show</button></a></td>
                                        @else
                                            <td style="color: red">Not Attend till now</td>
                                        @endif

                                        @if(! Helper::evaCheckerMs($user->exam->id))
                                            <td><a href="{{url('examCandidateMs/'.$user->exam->id)}}"><button class="btn btn-primary">Show</button></a></td>
                                        @else
                                            <td style="color: red">Not Attend till now</td>
                                        @endif

                                        <td>{{Helper::getEvaCheckerEnglish($user->exam->id)}}</td>
                                        <td>{{Helper::getEvaCheckerPersonal($user->exam->id)}}</td>
                                        <td>{{Helper::getEvaCheckerMs($user->exam->id)}}</td>
                                        <td>{{Helper::getTotalScore(Helper::getEvaCheckerMs($user->exam->id),Helper::getEvaCheckerPersonal($user->exam->id),Helper::getEvaCheckerEnglish($user->exam->id))}}</td>

                                    </tr>
                                    @endif

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


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header ">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Export Base on Creation Account</h4>
                    <div id ="form-errors"></div>
                </div>
                <div class="modal-body">
                    <form id="frmTasksExport" name="frmTasks" method="get" action="{{url('exportResult')}}" class="form-horizontal" novalidate="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 " >
                                <input class="form-control" placeholder="" type="date" name="startDate" required >

                            </div></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 " >
                                <input class="form-control" placeholder="" type="date" name="endDate" required >

                            </div></div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-right "  value="add">Export</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
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
            $('.adSearch').click(function(){

                $this = $(this);
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });
        })
    </script>

    <script>



    </script>
@endsection
@endsection