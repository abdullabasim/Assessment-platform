@extends('layouts.default')
@section('title')
    Analysis
@endsection

<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>

@section('content')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Analysis </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Analysis</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">


            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3 class="count">{{$totalCandidates}}</h3>

                            <p>Total Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <span  class="small-box-footer">Enter the Exam : {{$madeMsExamTotal + $madePersonalExamTotal + $madeEnglishExamTotal}} <i ></i></span>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 class="count">{{$englishTotalCandidates}}</h3>

                            <p>English Exam Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <span  class="small-box-footer">Enter the Exam : {{$madeEnglishExamTotal}} <i ></i></span>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 class="count">{{$personalTotalCandidates}}</h3>

                            <p>Personal Exam Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <span  class="small-box-footer">Enter the Exam : {{$madePersonalExamTotal}} <i ></i></span>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3 class="count">{{$msTotalCandidates}}</h3>

                            <p>Microsoft Office Candidate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-nuclear"></i>
                        </div>
                        <span  class="small-box-footer">Enter the Exam : {{$madeMsExamTotal}} <i ></i></span>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">

                            <h3 class="count">{{$notMadeExam}}</h3>

                            <p>Candidate Not Enter Exam</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-close"></i>
                        </div>
                        <span  class="small-box-footer"> <i class="fa fa-clipboard"></i></span>
                    </div>
                </div>
            </div>




            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Candidate Exam Result</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                @include('alertNotifications/alertNotifications')

                <div id="chartdiv"></div>
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
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>


    <script>
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 10000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

    </script>

    <script>
        var data ='{!! json_encode($results) !!}';
        data = JSON.parse(data);

        var chart = AmCharts.makeChart( "chartdiv", {
            "type": "pie",
            "theme": "light",
            "dataProvider":data ,
            "valueField": "litres",
            "titleField": "title",
            "balloon":{
                "fixedPosition":true
            },
            "export": {
                "enabled": true
            }
        } );
    </script>
@endsection
@endsection