@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>قائمة الاسعار</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الخدمة</th>
                                                <th>السعر</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prices as $index => $price)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><span>
                                                            @if ($price->model == 'report')
                                                                التقارير
                                                            @elseif ($price->model == 'meeting')
                                                                المقابلات
                                                            @elseif ($price->model == 'reservation')
                                                                حجوزات الاشعة والتحاليل
                                                            @endif
                                                        </span></td>
                                                    <td><span>{{ $price->price }}</span></td>
                                                    <td>
                                                        <span><a href="{{ route('edit price', $price->id) }}"
                                                                class="btn btn-warning">تعديل</a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
