@extends('layouts.default')
@section('title')
    Microsoft Office Exam
@endsection
@section('css')
    <style>

        label.btn span {
            font-size: 1.5em ;
        }

        label input[type="radio"] ~ i.fa.fa-circle-o{
            color: #0a0a0a;    display: inline;
        }
        label input[type="radio"] ~ i.fa.fa-dot-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
            color: #5cb85c;    display: inline;
        }
        label:hover input[type="radio"] ~ i.fa {
            color: #5cb85c;
        }

        label input[type="checkbox"] ~ i.fa.fa-square-o{
            color: #0a0a0a;    display: inline;
        }
        label input[type="checkbox"] ~ i.fa.fa-check-square-o{
            display: none;
        }
        label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
            display: none;
        }
        label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
            color: #5cb85c;    display: inline;
        }
        label:hover input[type="checkbox"] ~ i.fa {
            color: #5cb85c;
        }

        div[data-toggle="buttons"] label.active{
            color: #0a0a0a;
        }

        div[data-toggle="buttons"] label {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 2em;
            text-align: left;
            white-space: nowrap;
            vertical-align: top;
            cursor: pointer;

            border: 0px solid
            #0a0a0a;
            border-radius: 3px;
            color: #0a0a0a;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        div[data-toggle="buttons"] label:hover {
            color: #5cb85c;
        }

        div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
            -webkit-box-shadow: none;
            box-shadow: none;
        }



    </style>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Microsoft Office :
                <small style="color: #0b58a2"><b>{{$user->name}}</b></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Microsoft Office Exam</li>
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

                <!-- /.box-header -->
                <div class="box-body" id="item">


                    <form method="post" action="{{url('candidateMsExamCorrect')}}">
                        {{ csrf_field() }}


                        <input type="hidden" name="dumy" value="{{$ex}}">
                        <br>
                        @foreach($msExamQuestions as $key => $msExamQuestion)


                            @if(@$msExamQuestion->msQuestion->msAnswerType-> title == "Multiple Choice Question")
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-10">

                                            @if(@$msExamQuestion->msQuestion->msQuestionType-> id == 1)
                                            @if( \App\Helper\Helper::getCorrectAnswerMs(@$msExamQuestion->msQuestion->id) == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))


                                            <h4 style="font-weight: bold;color: green">Q{{$counter++}}: {{@$msExamQuestion->msQuestion->title}}</h4>

                                            @else
                                                <h4 style="font-weight: bold; color: red ">Q{{$counter++}}: {{@$msExamQuestion->msQuestion->title}}<span style="color: #0a0a0a">(Correct Answer is : {{\App\Helper\Helper::getCorrectAnswerMs(@$msExamQuestion->msQuestion->id)}})</span></h4>

                                            @endif
                                            <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                                <label class="btn active">
                                                    @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer1 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                    <input checked required type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}"  ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}</span>
                                                     @else
                                                        <input  required type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}"  ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}</span>
                                                     @endif
                                                </label>
                                                <label class="btn">
                                                    @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer2 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                    <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}</span>
                                                    @else
                                                        <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}</span>
                                                    @endif
                                                </label>
                                                <label class="btn">
                                                    @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer3 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))

                                                    <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}</span>
                                                    @else
                                                        <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}</span>
                                                   @endif
                                                </label>
                                                <label class="btn">
                                                    @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer4 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                    <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}</span>
                                                     @else
                                                        <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}</span>
                                                     @endif

                                                </label>
                                            </div>
                                             @elseif(@$msExamQuestion->msQuestion->msQuestionType-> id == 2)
                                                @if( \App\Helper\Helper::getCorrectAnswerMs(@$msExamQuestion->msQuestion->id) == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))


                                                    <h4 style="font-weight: bold;color: green">Q{{$counter++}}: {{@$msExamQuestion->$msExamQuestionQuestion->title}}</h4>
                                                    <img style="margin-left: 10px !important; margin-top: 5px ;border-radius: 1%;" width="800px" height="500px" src="{{asset('upload/Images/'.@$msExamQuestion->msQuestion->image_path)}}">

                                                @else
                                                    <h4 style="font-weight: bold; color: red ">Q{{$counter++}}: {{@$msExamQuestion->msQuestion->title}}<span style="color: #0a0a0a">(Correct Answer is : {{\App\Helper\Helper::getCorrectAnswerMs(@$msExamQuestion->msQuestion->id)}})</span></h4>

                                                @endif
                                                <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                                    <label class="btn active">
                                                        @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer1 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                            <input checked required type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}"  ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}</span>
                                                        @else
                                                            <input  required type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}"  ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer1}}</span>
                                                        @endif
                                                    </label>
                                                    <label class="btn">
                                                        @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer2 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                            <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}</span>
                                                        @else
                                                            <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer2}}</span>
                                                        @endif
                                                    </label>
                                                    <label class="btn">
                                                        @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer3 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))

                                                            <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}</span>
                                                        @else
                                                            <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer3}}</span>
                                                        @endif
                                                    </label>
                                                    <label class="btn">
                                                        @if(@$msExamQuestion->msQuestion->msQuestionAnswer->answer4 == \App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id))
                                                            <input checked type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}</span>
                                                        @else
                                                            <input  type="radio" value="{{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> {{@$msExamQuestion->msQuestion->msQuestionAnswer->answer4}}</span>
                                                        @endif

                                                    </label>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @elseif(@$msExamQuestion->msQuestion->msAnswerType-> title == "Written Answer")
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-10">

                                            @if(@$msExamQuestion->msQuestion->msQuestionType-> id == 1)
                                            <h4 style="font-weight: bold;">Q{{$counter++}}: {{@$msExamQuestion->msQuestion->title}}</h4>
                                            <div class="col-md-12">
                                                <input required type="number" min="0" max="1" name="score[{{@$msExamQuestion->msQuestion->id}}]" value="{{\App\Helper\Helper::getScoreMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id)}}"  class="form-control" style="width: 59px;float: right;margin-right: 138px;position: relative;top: 63px;box-shadow: 1px 1px 2px;border-radius: 2px;">
                                                <span style="float: right;position: relative;left: 44px;top: 38px;font-weight: bold;">Score : </span>
                                            </div>
                                            <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                                <textarea readonly  class="form-control" rows="5" cols="100" placeholder="Enter Answer" required>{{\App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id)}}</textarea>

                                            </div>
                                            @elseif(@$msExamQuestion->msQuestion->msQuestionType-> id == 2)
                                                <h4 style="font-weight: bold;">Q{{$counter++}}: {{@$msExamQuestion->msQuestion->title}}</h4>
                                                <img style="margin-left: 10px !important; margin-top: 5px ;border-radius: 1%;" width="800px" height="500px" src="{{asset('upload/Images/'.@$msExamQuestion->msQuestion->image_path)}}">

                                                <div class="col-md-12">
                                                    <input required type="number" min="0" max="2" name="score[{{@$msExamQuestion->msQuestion->id}}]" value="{{\App\Helper\Helper::getScoreMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id)}}"  class="form-control" style="width: 59px;float: right;margin-right: 138px;position: relative;top: 63px;box-shadow: 1px 1px 2px;border-radius: 2px;">
                                                    <span style="float: right;position: relative;left: 44px;top: 38px;font-weight: bold;">Score : </span>
                                                </div>
                                                <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                                    <textarea readonly  class="form-control" rows="5" cols="100" placeholder="Enter Answer" required>{{\App\Helper\Helper::getUserAnswerMs(@$msExamQuestion->ms_exam_id,@$msExamQuestion->msQuestion->id)}}</textarea>

                                                </div>
                                            @endif





                                        </div>

                                    </div>
                                    <span style="margin-left: 25px"><b>*Note:</b>Question Score  between 0 to 2</span>
                                </div>
                            @endif
                        @endforeach

                        <br>


                        <div style="margin-top: 40px" class="row">

                            <div class="col-md-2  col-md-offset-5 form-group" >

                                <button   type="submit" class="btn btn-block btn-success ">Save Exam Answers  <span  id="plus"    class="glyphicon glyphicon-floppy-open">  </span></button>


                            </div>
                        </div>

                    </form>
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



@endsection
@endsection