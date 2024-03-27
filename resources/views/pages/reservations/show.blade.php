@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <form class="display-block w-100" action="{{ route('reserve', $reservation->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="header">
                            <h2>حجز اشعة او تحليل</h2>
                        </div>
                        <div class="body flex">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">الاسم: </h6>
                                    <h6>{{ $reservation->user->first_name . ' ' . $reservation->user->last_name }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">البريد الاليكترونى: </h6>
                                    <h6>{{ $reservation->user->email }}</h6>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">الهاتف: </h6>
                                    <h6>{{ $reservation->user->phone }}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="text-muted">الجنس: </h6>
                                    <h6>{{ $reservation->user->gender }}</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6 class="text-muted">العمر: </h6>
                                    <h6>{{ $reservation->user->age }}</h6>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">الأشاعات</h6>
                                    <h6>
                                        @if (!empty($reservation->rays))
                                            @foreach ($reservation->rays as $rays)
                                                - {{ $rays }} <br>
                                            @endforeach
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">الملاحظات: </h6>
                                    <h6>{{ $reservation->rays_notes }}</h6>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">التحاليل</h6>
                                    <h6>
                                        @if (!empty($reservation->analysis))
                                            @foreach ($reservation->analysis as $analysis)
                                                - {{ $analysis }} <br>
                                            @endforeach
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">الملاحظات: </h6>
                                    <h6>{{ $reservation->analysis_notes }}</h6>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">اسم المشفي او المعمل : </h6>
                                    <h6>{{ $reservation->hospital->name }}</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">الوقت: </h6>
                                    <input type="date" min="{{ today() }}" name="date"
                                        value="{{ $reservation->date == null ? now()->format('Y-m-d') : \Illuminate\Support\Carbon::parse($reservation->date)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">الحالة </h6>
                                    <select name="status" class="selectpicker" title="الحالة">
                                        <option {{ $reservation->status == 'انتظار' ? 'selected' : '' }} value="انتظار">
                                            انتظار</option>
                                        <option {{ $reservation->status == 'تم الحجز' ? 'selected' : '' }}
                                            value="تم الحجز">
                                            تم الحجز
                                        </option>
                                        <option {{ $reservation->status == 'مرفوض' ? 'selected' : '' }} value="مرفوض">
                                            مرفوض
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">اثبات التحويل :</h6>
                                    <img style="width: 300px" src="/{{ $reservation->transaction }}" alt="">
                                </div>
                            </div>
                            <hr>
                            <div class="text-left">
                                <button type="submit" class="btn btn-md btn-primary ">حفظ</button>
                                <a href="{{ route('show reservations') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
