@extends('layouts.default')
@section('title')
    Add Main Question
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Add Main Question </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Main Question</li>
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
                <form id="formId" method="post" action="{{url('addEnglishMainQuestion')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body" id="item">



                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Question Type</label>
                                    <select  name="questionPart" id="questionPart" class="form-control select2" data-placeholder="Select Question Type" style="width: 100%;">
                                        <option selected="selected"> </option>
                                        @foreach($questionParts as $questionPart)
                                            <option value="{{$questionPart->id}}">{{$questionPart->title}}</option>
                                        @endforeach
                                    </select>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /Question Type  Body -->








                         <div class="item">


                         </div>















                    <div class="row">

                        <div class="col-md-2  col-md-offset-5 form-group" >

                            <button  style=" visibility: hidden;" id ="buttonSave" type="submit" class="btn btn-block btn-success ">Save Question  <span  id="plus"    class="glyphicon glyphicon-floppy-open">  </span></button>


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
        $(document).ready(function(){

         //  var counter = 1 ;
            var selection = "";
          //  var id = 'question'+counter;
           $("#questionPart").change(function (e) {

              var btn = document.getElementById('buttonSave');

             btn.style.visibility = "visible";

                var element = $(this);
                 selection = this.value;
                var items = $(".item");

                if(selection == 1)
                {
                  //   alert('question'+counter);
                   //  id = 'question'+counter;
                 //  items.innerHTML = "";
                   $('.item').empty();
                    items.append(
                        '                        <div class="row">\n' +
                        '\n' +
                        '\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +

                        '                                <div class="form-group">\n' +
                        '                                    <label>Question</label>\n' +
                        '                                    <textarea id ="questionBody11" name="grammarQuestion" class="form-control" rows="3" placeholder="Enter Question Body" required ></textarea>                                </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <!-- /Question Body -->\n' +
                        '\n' +
                        '                        <!-- Answer 1 Body -->\n' +
                        '                        <div class="row" style="margin-top: -200px;">\n' +
                        '\n' +
                        '\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Answer 1</label>\n' +
                        '                                    <input id ="answer11" name="answer1" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <!-- /Answer 1 Body -->\n' +
                        '\n' +
                        '                        <!-- Answer 2 Body -->\n' +
                        '                        <div class="row">\n' +
                        '\n' +
                        '\n' +
                            '<input name="question" value="grammar" type="hidden"   required> '+

                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Answer 2</label>\n' +
                        '                                    <input id ="answer22" name="answer2" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <!-- /Answer 1 Body -->\n' +
                        '\n' +
                        '                        <!-- Answer 3 Body -->\n' +
                        '                        <div class="row">\n' +
                        '\n' +
                        '\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Answer 3</label>\n' +
                        '                                    <input id ="answer33" name="answer3" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <!-- /Answer 3 Body -->\n' +
                        '\n' +
                        '                        <!-- Answer 4 Body -->\n' +
                        '                        <div class="row">\n' +
                        '\n' +
                        '\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Answer 4</label>\n' +
                        '                                    <input id ="answer44" name="answer4" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +
                        '                        <!-- /Answer 4 Body -->\n' +
                        '\n' +
                        '                        <!-- Correct Answer 1 Body -->\n' +
                        '                        <div class="row">\n' +
                        '\n' +
                        '\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Correct Answer </label>\n' +
                        '                                    <select  name="correctAnswer" id="correctAnswer1" class="form-control select2" data-placeholder="Select Question Type" style="width: 100%;" required>\n' +
                        '                                        <option selected="selected"></option>\n' +
                        '                                        <option value="answer1">Answer 1</option>\n' +
                        '                                        <option value="answer2">Answer 2</option>\n' +
                        '                                        <option value="answer3">Answer 3</option>\n' +
                        '                                        <option value="answer4">Answer 4</option>\n' +
                        '                                    </select>\n' +
                        '                                </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                        </div>\n' +

                        '                        </div>\n' +
                        '                        <!-- /Correct Answer 1 Body -->');




                  //  questionType.selection = "";


                }
                else if (selection == 2)
                {
                 //   alert('question'+counter);
                    $('.item').empty();
                  //  items.innerHTML = "";
                    items.append(

                        '<div class="row" style="margin-top: -200px;">\n' +
                        '\n' +
                        '                            <!-- /.col -->\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Question Box</label>\n' +
                        '<input name="question" value="written" type="hidden"   required> '+
                        '                                    <textarea id ="questionBody22"  name="questionBody2" class="form-control" rows="5" placeholder="Enter Paragraph Here" required></textarea>\n' +
                        '\n' +
                        '                                </div>\n' +
                        '\n' +
                        '\n' +
                        '                            </div>\n' +
                        '                            <!-- /.col -->\n' +
                        '                                </div>\n' +

                        '                        </div>');
                }
                else if (selection == 3)
                {

                    $('.item').empty();

                    items.append(

                        '<div class="row" style="margin-top: -200px;">\n' +
                        '\n' +
                        '                            <!-- /.col -->\n' +
                        '                            <div class="col-md-6  col-md-offset-3">\n' +

                        '                                <div class="form-group">\n' +
                        '                                    <label>Audio Title</label>\n' +

                        '<input name="question" value="audio" type="hidden"   required> '+
                        '\n' +
                                                            '<input name="questionBody3"  type="text" placeholder="Enter Audio Title"  class="form-control"  required >'+
                        '                                </div>\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label>Audio Question</label>\n' +
                        '                                    <input id="audio" name="audioFile"  type="file"  class="form-control" accept="audio/*" required >\n' +
                        '\n' +
                        '                                </div>\n' +
                        '\n' +
                        '\n' +
                        '                            </div>\n' +
                        '                            <!-- /.col -->\n' +
                        '                                </div>\n' +

                        '                        </div>');
                }



            });

            $(".nano").click(function (e) {

         alert("yes");
                var btn = document.getElementById('buttonSave');

                btn.style.visibility = "visible";

//                elements = document.getElementById('question'+counter);
//                if (elements) {
//
//                    elements.innerHTML = "";
//                    document.getElementById('question'+counter).remove();
//                }


                {{--var element = $(this);--}}
                {{--selection = this.value;--}}
                {{--var items = $("#item");--}}
                {{--alert($(this));--}}

                {{--if(selection == 1)--}}
                {{--{--}}
                    {{--//   alert('question'+counter);--}}
                    {{--id = 'question'+counter;--}}
                    {{--items.append(--}}

                        {{--'                        <div class="row">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--' <div class="form-group">\n' +--}}
                        {{--'  <label>Question Difficulty</label>\n' +--}}
                        {{--'  <select  name="questionDifficulty" id="questionDifficulty" class="form-control select2" data-placeholder="Select Question Difficulty" style="width: 100%;">\n' +--}}
                        {{--' <option selected="selected"> </option>\n' +--}}
                            {{--@foreach($difficulties as $difficulty)--}}
                                {{--'<option value="{{$difficulty->id}}">{{$difficulty->title}}</option>\n' +--}}
                            {{--@endforeach--}}
                                {{--'</select>\n' +--}}


                        {{--'</div>\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Question</label>\n' +--}}
                        {{--'                                    <textarea id ="questionBody11" name="questionBody1" class="form-control" rows="3" placeholder="Enter Question Body" required ></textarea>                                </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Question Body -->\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        <!-- Answer 1 Body -->\n' +--}}
                        {{--'                        <div class="row" style="margin-top: -200px;">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Answer 1</label>\n' +--}}
                        {{--'                                    <input id ="answer11" name="answer1" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Answer 1 Body -->\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        <!-- Answer 2 Body -->\n' +--}}
                        {{--'                        <div class="row">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Answer 2</label>\n' +--}}
                        {{--'                                    <input id ="answer22" name="answer2" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Answer 1 Body -->\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        <!-- Answer 3 Body -->\n' +--}}
                        {{--'                        <div class="row">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Answer 3</label>\n' +--}}
                        {{--'                                    <input id ="answer33" name="answer3" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Answer 3 Body -->\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        <!-- Answer 4 Body -->\n' +--}}
                        {{--'                        <div class="row">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Answer 4</label>\n' +--}}
                        {{--'                                    <input id ="answer44" name="answer4" type="text" class="form-control" placeholder="Enter ..." required>                               </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Answer 4 Body -->\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        <!-- Correct Answer 1 Body -->\n' +--}}
                        {{--'                        <div class="row">\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Correct Answer </label>\n' +--}}
                        {{--'                                    <select  name="correctAnswer" id="correctAnswer1" class="form-control select2" data-placeholder="Select Question Type" style="width: 100%;" required>\n' +--}}
                        {{--'                                        <option selected="selected"></option>\n' +--}}
                        {{--'                                        <option value="answer1">Answer 1</option>\n' +--}}
                        {{--'                                        <option value="answer2">Answer 2</option>\n' +--}}
                        {{--'                                        <option value="answer3">Answer 3</option>\n' +--}}
                        {{--'                                        <option value="answer4">Answer 4</option>\n' +--}}
                        {{--'                                    </select>\n' +--}}
                        {{--'                                </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                        </div>\n' +--}}

                        {{--'                        </div>\n' +--}}
                        {{--'                        <!-- /Correct Answer 1 Body -->');--}}
                    {{--//questionType.selection = "";--}}


                {{--}--}}
                {{--else if (selection == 2)--}}
                {{--{--}}
                    {{--//   alert('question'+counter);--}}
                 {{--//   id = 'question'+counter;--}}
                    {{--items.append(--}}
                        {{--'                        <div >\n' +--}}
                        {{--'<div class="row" style="margin-top: -200px;">\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            <!-- /.col -->\n' +--}}
                        {{--'                            <div class="col-md-6  col-md-offset-3">\n' +--}}
                        {{--' <div class="form-group">\n' +--}}
                        {{--'  <label>Question Difficulty</label>\n' +--}}
                        {{--'  <select  name="questionDifficulty" id="questionDifficulty" class="form-control select2" data-placeholder="Select Question Difficulty" style="width: 100%;">\n' +--}}
                        {{--' <option selected="selected"> </option>\n' +--}}
                            {{--@foreach($difficulties as $difficulty)--}}
                                {{--'<option value="{{$difficulty->id}}">{{$difficulty->title}}</option>\n' +--}}
                            {{--@endforeach--}}
                                {{--'</select>\n' +--}}


                        {{--'</div>\n' +--}}
                        {{--'                                <div class="form-group">\n' +--}}
                        {{--'                                    <label>Question Box</label>\n' +--}}
                        {{--'                                    <textarea id ="questionBody22"  name="questionBody2" class="form-control" rows="5" placeholder="Enter Question Body" required></textarea>\n' +--}}
                        {{--'\n' +--}}
                        {{--'                                </div>\n' +--}}
                        {{--'\n' +--}}
                        {{--'\n' +--}}
                        {{--'                            </div>\n' +--}}
                        {{--'                            <!-- /.col -->\n' +--}}
                        {{--'                                </div>\n' +--}}

                        {{--'                        </div>');--}}
                {{--}--}}




            });



        });

        $(document).ready(function(){

            $("#questionTypess").change(function (e) {

              alert("yes");


            });



        })


    </script>
@endsection
@endsection