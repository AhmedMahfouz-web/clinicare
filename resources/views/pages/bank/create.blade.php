@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>اضافة حساب </h2>
                            </div>
                            <div class="body">
                                <form action="{{ route('store numbers') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6 mb-3">
                                            <label for="bank" class="mr-1 control-label">اسم الحساب</label>
                                            <input type="text" id="bank" name="bank" class="form-control"
                                                placeholder="اسم المستخدم" value="" aria-label="bank"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div class="form-group col-6 mb-3">
                                            <label for="price" class="mr-1 control-label">الرقم</label>
                                            <input type="text" id="price" name="number" class="form-control"
                                                placeholder="رقم الحساب" value="" aria-label="price"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div class="form-group col-6 mb-3">
                                            <label for="iban" class="mr-1 control-label">iban</label>
                                            <input type="text" id="iban" name="iban" class="form-control"
                                                placeholder="iban" value="" aria-label="iban"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="text-left mt-5">
                                        <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                        <a href="{{ route('show numbers') }}" class="btn btn-md btn-secondary">الغاء</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
