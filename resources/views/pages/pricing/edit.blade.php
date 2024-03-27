@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>تعديل السعر</h2>
                            </div>
                            <div class="body">
                                <form action="{{ route('update price', $price) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6 mb-3">
                                            <label for="name" class="mr-1 control-label">الخدمة</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="اسم المستخدم" value="{{ $price->model }}" aria-label="name"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div class="form-group col-6 mb-3">
                                            <label for="price" class="mr-1 control-label">السعر</label>
                                            <input type="number" id="price" name="price" class="form-control"
                                                placeholder="سعر الخدمة" value="{{ $price->price }}" aria-label="price"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="text-left mt-5">
                                        <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                        <a href="{{ route('show prices') }}" class="btn btn-md btn-secondary">الغاء</a>
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
