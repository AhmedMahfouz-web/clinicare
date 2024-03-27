@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="header">
                        <h2>عرض الرسالة </h2>
                    </div>
                    <div class="body flex">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">الاسم: </h6>
                                <h6>{{ $message->name }}</h6>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">الهاتف: </h6>
                                <h6>{{ $message->phone }}</h6>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">الايميل: </h6>
                                <h6>{{ $message->email }}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="text-muted">الرسالة: </h6>
                                <div>{{ $message->message }}</div>
                            </div>
                        </div>
                        <div class="text-left mt-5">
                            <a href="{{ route('show contact') }}" class="btn btn-md btn-secondary">الرجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
