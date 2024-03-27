@extends('layouts.dashboard')
@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> اضافة مدونة</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('store blog') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12 mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                            data-multiple-caption="{count} files selected" id="inputGroupFile02">
                                        <label class="custom-file-label" for="inputGroupFile02"><span>اختر
                                                الصورة</span></label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">اختر</span>
                                    </div>
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="title" class="mr-1 control-label">عنوان المدونة</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        placeholder="عنوان المدونة" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-12 mb-3">
                                    <label for="title" class="mr-1 control-label">وصف المدونة</label>
                                    <textarea id="summernote" name="body"></textarea>
                                </div>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show blogs') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'اكتب مدونة...',
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
