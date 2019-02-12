@extends('layouts.default')
@section('title')
    Edit Microsoft Office Question Box
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small> Edit Microsoft Office Question Box </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Edit Microsoft Office Question Box</li>
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
                <form id="formId" method="post" action="{{url('editMsBoxQuestion')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body" id="item">


                        <div class="col-md-6  ">
                       <input type="hidden" name="questionId" value="{{$questionBox->id}}">

                            <div class="row">

                                <!-- /.col -->
                                <div class="col-md-12  col-md-offset-1">
                                    <div class="form-group">
                                        <label>Microsoft Office Section</label>
                                        <select  name="questionSection"  class="form-control select2" data-placeholder="Select Question Difficult" style="width: 100%;">
                                            <option selected="selected"> </option>
                                            @foreach($questionSections as $questionSection)
                                                @if($questionBox->msQuestionSection->id == $questionSection->id)
                                                    <option selected value="{{$questionSection->id}}">{{$questionSection->title}}</option>
                                                @else
                                                    <option  value="{{$questionSection->id}}">{{$questionSection->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>


                                    </div>


                                </div>
                                <!-- /.col -->
                            </div>
                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-12  col-md-offset-1">
                                <div class="form-group">
                                    <label>Question Title</label>
                                    <textarea name="title" class="form-control" rows="5" placeholder="Enter Paragraph Here" required>{{$questionBox->title}}</textarea>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                            <div class="row">

                                <!-- /.col -->
                                <div class="col-md-12  col-md-offset-1">
                                    <div class="form-group">
                                        <label> Upload Other Question  Image</label>
                                        <input id ="images" name="image" type="file" class="form-control"  >

                                    </div>


                                </div>
                                <!-- /.col -->
                            </div>





                        </div>
                        <div class="col-md-6 " >
                            @if($questionBox->msQuestionType->id == 2 )
                                <img style="margin-left: 35px !important;margin-top: 20px" width="450px" height="350px" src="{{asset('upload/Images/'.$questionBox->image_path)}}">
                            @endif
                        </div>


                    <div class="row">

                        <div class="col-md-2  col-md-offset-5 form-group" style="margin-top: 25px;" >

                            <button  id ="buttonSave" type="submit" class="btn btn-block btn-success ">Edit Question  <span  id="plus"    class="glyphicon glyphicon-floppy-open">  </span></button>


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

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endsection
@endsection