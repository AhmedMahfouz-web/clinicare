@extends('layouts.dashboard')

@section('content')
    <div class="modal modal-danger fade" id="modal_5" tabindex="-1" role="dialog" aria-labelledby="modal_5"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title_6">احترس !</h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="fa fa-exclamation-circle fa-4x"></i>
                        <h4 class="heading mt-4">هل انت متأكد من حذف التقييم ؟</h4>
                        <p> للموافقة اضغط "حذف"</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md " data-dismiss="modal">الغاء</button>
                    <button type="submit" form="" id="delete_btn" class="btn btn-md btn-secondary">حذف</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="tab-content">
            <div class="tab-pane fade show active" id="More-table" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>قائمة التقييمات</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>البريد الاليكتروني</th>
                                                <th>الهاتف</th>
                                                <th>النجوم</th>
                                                <th>رأي العميل</th>
                                                <th>عرض في الموقع</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $index => $review)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td><span>{{ $review->user->first_name . ' ' . $review->user->last_name }}</span>
                                                    </td>
                                                    <td><span>{{ $review->user->email }}</span></td>
                                                    <td><span>{{ $review->user->phone }}</span></td>
                                                    <td><span>{{ $review->stars }}</span></td>
                                                    <td><span>{{ $review->review }}</span></td>
                                                    <td>
                                                        <label class="toggle-switch">
                                                            <input type="checkbox" class="show-toggle"
                                                                data-link="{{ route('show review', $review->id) }}"
                                                                {{ $review->show == 1 ? 'checked' : '' }}>
                                                            <span class="toggle-switch-slider rounded-circle"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <form class="d-inline" id="form-{{ $review->id }}"
                                                            action="{{ route('delete review', $review) }}" method="post">
                                                            @csrf
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#modal_5" data-form="form-{{ $review->id }}"
                                                                class="btn btn-danger btn-md delete_btn"><i
                                                                    class="fa-regular fa-trash-can"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="Page navigation example">
                                        {!! $reviews->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let delete_btn = document.getElementsByClassName('delete_btn');
        const submit_btn = document.getElementById('delete_btn');
        for (let i = 0; i < delete_btn.length; i++) {
            delete_btn[i].addEventListener('click', function() {
                console.log(delete_btn[i].getAttribute('data-form'))
                submit_btn.setAttribute('form', delete_btn[i].getAttribute('data-form'));
            })

        };
        let show_btn = document.getElementsByClassName('show-toggle');
        for (let i = 0; i < show_btn.length; i++) {
            show_btn[i].addEventListener('change', function() {
                let link = show_btn[i].getAttribute('data-link');
                window.open(link);
            })
        }
    </script>
@endsection
