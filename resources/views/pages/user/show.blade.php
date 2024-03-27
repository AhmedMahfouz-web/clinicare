@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="header">
                        <h2>طلب تقرير</h2>
                    </div>
                    <div class="body flex">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الاسم: </h6>
                                <h6>{{ $user->first_name . ' ' . $user->last_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">البريد الالكترونى: </h6>
                                <h6>{{ $user->email }}</h6>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الهاتف: </h6>
                                <h6>{{ $user->phone }}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted">الجنس: </h6>
                                <h6>{{ $user->gender }}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted">العمر: </h6>
                                <h6>{{ $user->age }}</h6>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الصورة الشخصية :</h6>
                                <img style="width: 300px" src="/{{ $user->image }}" alt="">
                            </div>
                        </div>
                        <div class="text-left">
                            <a href="{{ route('show users') }}" class="btn btn-md btn-secondary">رجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
