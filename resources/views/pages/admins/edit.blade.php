@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> اضافة ادارى</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('update admin', $admin) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label for="name" class="mr-1 control-label">اسم المستخدم</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="اسم المستخدم" value="{{ $admin->name }}" aria-label="name"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="email" class="mr-1 control-label">البريد الالكتروني</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="البريد الالكتروني" value="{{ $admin->email }}" aria-label="email"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label for="role" class="mr-1 control-label">الوظيفة</label>
                                    <select name="role" id="role" class="form-control show-tick ms select2"
                                        data-placeholder="اختر الوظيفة">
                                        <option></option>
                                        <option {{ $admin->role == 'صاحب منشأة' ? 'selected' : '' }} value="صاحب منشأة">صاحب
                                            المنشأة
                                        </option>
                                        <option {{ $admin->role == 'ادمن' ? 'selected' : '' }} value="ادمن">ادمن</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show admins') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
