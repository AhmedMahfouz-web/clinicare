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
                                <h6>{{ $doctor->first_name . ' ' . $doctor->last_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">البريد الالكترونى: </h6>
                                <h6>{{ $doctor->email }}</h6>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الهاتف: </h6>
                                <h6>{{ $doctor->phone }}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted">الجنس: </h6>
                                <h6>{{ $doctor->gender }}</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted">العمر: </h6>
                                <h6>{{ $doctor->age }}</h6>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">المدينة </h6>
                                <h6>{{ $doctor->country }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">جهة العمل </h6>
                                <h6>{{ $doctor->work_at }}</h6>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">الخبرة </h6>
                                <h6>{{ $doctor->experince }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">نبذة: </h6>
                                <h6>{{ $doctor->bio }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">التخصص: </h6>
                                <h6>{{ $doctor->profession }}</h6>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">السيرة الذاتية: </h6>
                                <a class="btn" href="/{{ $doctor->cv }}" download="{{ $doctor->cv }}">تحميل
                                    {{ $doctor->cv }}</a>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الصورة الشخصية :</h6>
                                <img style="width: 300px" src="/{{ $doctor->image }}" alt="">
                            </div>
                        </div>
                        <div class="text-left">
                            <a href="{{ route('show doctors ') }}" class="btn btn-md btn-secondary">رجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
