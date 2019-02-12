@extends('layouts.default')
@section('title')
    Edit Question Multi Choose
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Edit Question Multi Choose </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Edit Question Multi Choose</li>
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
                <form id="formId" method="post" action="{{url('questionsMultiDetails')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body" id="item">


                       <input type="hidden" name="questionId" value="{{$questionMultiChooses->id}}">
                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Question Title</label>
                                    <textarea name="title" class="form-control" rows="5" placeholder="Enter Paragraph Here" required>{{$questionMultiChooses->title}}</textarea>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /Question Type  Body -->

                        <div class="row">

                            <!-- /.col -->

                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Answer 1</label>

                                  <input name="answer1"  class="form-control " style="width: 100%;" value="{{$questionMultiChooses->englishQuestionAnswer->answer1}}">


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Answer 2</label>

                                    <input name="answer2"  class="form-control " style="width: 100%;" value="{{$questionMultiChooses->englishQuestionAnswer->answer2}}">


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Answer 3</label>

                                    <input name="answer3"  class="form-control " style="width: 100%;" value="{{$questionMultiChooses->englishQuestionAnswer->answer3}}">


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Answer 4</label>

                                    <input name="answer4"  class="form-control " style="width: 100%;" value="{{$questionMultiChooses->englishQuestionAnswer->answer4}}">


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Correct Answer </label>


                                    <select  name="correct"  class="form-control select2" data-placeholder="Select Correct Answer" style="width: 100%;" required>
                                        <option selected="selected"></option>

                                        @foreach($answers as $answer)
                                            @if($answer == $questionMultiChooses->englishQuestionAnswer->correct )
                                            <option selected value="{{$answer}}">{{$answer}}</option>
                                                @else
                                                <option  value="{{$answer}}">{{$answer}}</option>
                                            @endif
                                        @endforeach




                                    </select>

                                </div>


                            </div>
                            <!-- /.col -->
                        </div>











                    <div class="row">

                        <div class="col-md-2  col-md-offset-5 form-group" >

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


@endsection
@endsection