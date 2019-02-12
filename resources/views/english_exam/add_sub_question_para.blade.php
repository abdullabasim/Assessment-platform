@extends('layouts.default')
@section('title')
    Add Paragraph Questions
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Add Sub Questions </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Sub Questions</li>
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
                <form id="formId" method="post" action="{{url('addEnglishSubQuestion')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- /.box-header -->
                    <div class="box-body" id="item">

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Main Question Type</label>
                                    <select  name="mainQuestionType" id="mainQuestionType" class="form-control select2" data-placeholder="Select Main Question Type" style="width: 100%;">
                                        <option selected="selected"> </option>
                                        <option title="Paragraph Questions" value="2">Paragraph Questions</option>
                                        <option title="Audio Questions" value="3">Audio Questions</option>
                                    </select>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Question Title</label>
                                    <select  name="questionTtile" id="questionTtile" class="form-control select2" data-placeholder="Select Question Title" style="width: 100%;">
                                        <option selected="selected"> </option>

                                    </select>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /Question Type  Body -->

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6  col-md-offset-1">
                                <div class="form-group">
                                    <label>Sub Question Type</label>
                                    <select  name="questionType" id="questionType" class="form-control select2" data-placeholder="Select Question Type" style="width: 100%;">
                                        <option selected="selected"> </option>
                                        @foreach($questionTypes as $questionType)
                                            <option title="{{$questionType->title}}" value="{{$questionType->id}}">{{str_limit($questionType->title, 200)}}</option>
                                        @endforeach
                                    </select>


                                </div>


                            </div>
                            <!-- /.col -->
                        </div>






                         <div class="item">


                         </div>















                    <div class="row">

                        <div class="col-md-2  col-md-offset-5 form-group" >

                            <button  style=" visibility: hidden;" id ="buttonSave" type="submit" class="btn btn-block btn-success ">Save Question  <span  id="plus"    class="glyphicon glyphicon-floppy-open">  </span></button>


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

            $("#questionTtile").select2({
                allowClear: true,

            })
        });
        $(document).ready(function(){


            var selection = "";

           $("#questionType").change(function (e) {

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
                        '                                    <textarea id ="questionBody11" name="titleQuestion" class="form-control" rows="3" placeholder="Enter Question Body" required ></textarea>                                </div>\n' +
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



                }
                else if (selection == 2)
                {
                 //   alert('question'+counter);
                    $('.item').empty();
                  //  items.innerHTML = "";
                    items.append(''+


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
                        '                            <div class="col-md-6  col-md-offset-3">\n' +

                        '                        </div>');
                }




            });





        });

        $(document).ready(function(){


            $("#mainQuestionType").change(function (e) {

                var element = $(this);
                var selection = this.value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    questionTypeId:selection ,

                }

                console.log(formData);

                $.ajax({

                    type: "post",
                    url: "/getQuestions",
                    data: formData,
                    dataType    : 'json',
                    success: function (data) {



                        console.log(data);
                        document.getElementById('questionTtile').options.length = 0;
                        var select = document.getElementById("questionTtile");
                        var opt ="";
                        var el = document.createElement("option");
                        el.textContent = opt;
                        el.value = opt;
                        select.appendChild(el);
                        for(var i = 0; i < data.length; i++) {
                            var opt = data[i];
                            var el = document.createElement("option");
                            el.textContent = opt;
                            el.value = opt;
                            select.appendChild(el);
                        }
                    },
                    error: function (data) {


                        console.log(data);

                    }
                });
            });



        });


    </script>
@endsection
@endsection