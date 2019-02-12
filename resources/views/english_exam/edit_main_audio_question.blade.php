@extends('layouts.default')
@section('title')
   Edit Audio Question Box
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Edit Audio Question Box </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Edit Audio Question Box</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                @include('alertNotifications/alertNotifications')
                <div id="errorsJs"></div>
                <form id="formId" method="post" action="{{url('editAudioMainQuestion')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body" id="item">


                       <input type="hidden" name="questionId" value="{{$questionAudio->id}}">
                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Question Title</label>
                                    <textarea name="title" class="form-control" rows="5" placeholder="Enter Paragraph Here" required>{{$questionAudio->title}}</textarea>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Upload Audio</label>
                                    <input  name="audioFile"  type="file"  class="form-control" accept="audio/*"  >

                                </div>


                            </div>
                            <!-- /.col -->
                        </div>


                    <div class="row">

                        <div class="col-md-2  col-md-offset-5 form-group" >

                            <button  id ="buttonSave" type="submit" class="btn btn-block btn-success ">Edit Main Question  <span  id="plus"    class="glyphicon glyphicon-floppy-open">  </span></button>


                        </div>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </form>
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


@endsection
@endsection