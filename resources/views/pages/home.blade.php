@extends('layouts.dashboard')

@section('css')
    <style>
        .card {
            border-radius: 2em !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card rounded-6 widget_2 big_icon traffic">
                    <a href="{{ route('show users') }}">
                        <div class="body">
                            <h6>المستخدمين</h6>
                            <h2>ذكور
                                {{ $users_male_count }}
                                &nbsp;&nbsp;&nbsp;اناث {{ $users_female_count }}
                            </h2>
                            <small>اجمالي عدد المستخدمين</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <a href="{{ route('show doctors') }}">
                        <div class="body">
                            <h6>الاطباء</h6>
                            <h2>ذكور {{ $doctors_male_count }} &nbsp;&nbsp;&nbsp;اناث {{ $doctors_female_count }}</h2>
                            <small>اجمالي عدد الاطباء</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <a href="{{ route('show hospitals') }}">
                        <div class="body">
                            <h6>المستشفيات</h6>
                            <h2>{{ $hospitals_count }}</h2>
                            <small>اجمالي عدد المستشفيات</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <a href="{{ route('show reports') }}">
                        <div class="body">
                            <h6>التقارير الطبية المطلوبة</h6>
                            <h2>{{ $reports_count }}</h2>
                            <small>اجمالي عدد التحاليل و الاشعات المتاحة</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <a href="{{ route('show reservations') }}">
                        <div class="body">
                            <h6>التحاليل و الاشعة المطلوبة</h6>
                            <h2>{{ $reservations_count }}</h2>
                            <small>اجمالي عدد التحاليل و الاشعات المتاحة</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card tasks_report">
                    <a href="{{ route('show meetings') }}">
                        <div class="body">
                            <h6>المقابلات المطلوبة</h6>
                            <h2>{{ $meetings_count }}</h2>
                            <small>اجمالي عدد المقابلات المطلوبة</small>
                            <div class="progress mb-0">
                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="89" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;"></div>
                            </div>


                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendor/jquery-sparkline/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-knob/jquery.knob.min.js') }}"></script> <!-- Jquery Knob Plugin Js -->
    <script src="{{ asset('js/pages/widgets.js') }}"></script>
@endsection
