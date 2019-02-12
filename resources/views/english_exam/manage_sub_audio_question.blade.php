@extends('layouts.default')
@section('title')
    Manage Sub Audio Questions
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
                <small>Manage Sub Audio Questions </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Sub Audio Questions</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">
            <div >

                @include('alertNotifications/alertNotifications')

                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage English Audio Questions</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Question Type</th>

                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($audioQuestions as $audioQuestion)
                                <tr>
                                    @if($audioQuestion->englishQuestionType->id == 1)
                                        <td><a style="color: WindowText; " href="{{url('questionMultiDetails/'.$audioQuestion->id)}}">{{$audioQuestion->id}}</a></td>
                                        <td><a style="color: WindowText; " href="{{url('questionMultiDetails/'.$audioQuestion->id)}}">{{$audioQuestion->title}}</a></td>
                                        <td><a style="color: WindowText; " href="{{url('questionMultiDetails/'.$audioQuestion->id)}}">{{$audioQuestion->englishQuestionType->title}}</a></td>
                                        <td><a style="color: WindowText; " href="{{url('questionMultiDetails/'.$audioQuestion->id)}}">{{$audioQuestion->questionLevel->title}}</a></td>
                                        <td  >
                                            <a style="color: WindowText; " href="{{url('questionMultiDetails/'.$audioQuestion->id)}}"><i title="Edit Question" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            {{--<a style="color: WindowText; "><i title="Delete Question" data-file-id="{{$audioQuestion->id}}" class="fa fa-trash btn-delete"></i></a></td>--}}
                                        </td>
                                    @else

                                  <td>{{$audioQuestion->id}}</td>
                                  <td>{{$audioQuestion->title}}</td>
                                  <td>{{$audioQuestion->englishQuestionType->title}}</td>

                                        <td  >
                                            <a style="color: WindowText; " href="{{url('editGrammarBoxQuestion/'.$audioQuestion->id)}}"><i title="Edit Question" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            {{--<a style="color: WindowText; "><i title="Delete Question" data-file-id="{{$audioQuestion->id}}" class="fa fa-trash btn-delete"></i></a></td>--}}
                                        </td>
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

        <div class="modal fade" id="myModalDelete" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Audio Question</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Audio Question?</p>
                        <div style="margin-left: 70px">
                            <button type="button" class="btn btn-info btn-yes" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
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
                'autoWidth'   : true
            })
        })
    </script>

    <script>

        $(document).ready(function(){
            // var fileID;
            var url = "/deleteGrammarQuestion/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });

    </script>
@endsection
@endsection