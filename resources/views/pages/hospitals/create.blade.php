@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> اضافة مشفي او معمل</h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('store hospital') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label for="name" class="mr-1 control-label">اسم المشفي</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="اسم المشفي" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="type" class="mr-1 control-label"> النوع</label>
                                    <select name="type" class="selectpicker" title="اختر النوع">
                                        <option value="مشفي">
                                            مشفي</option>
                                        <option value="معمل">
                                            معمل
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="phone" class="mr-1 control-label">رقم الهاتف</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        placeholder="رقم الهاتف" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="email" class="mr-1 control-label">الايميل</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="الايميل" aria-label="email" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="pr" class="mr-1 control-label">الموظف المسئول</label>
                                    <input type="text" id="pr" name="pr" class="form-control"
                                        placeholder="الموظف المسئول" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="bio" class="mr-1 control-label">نبذة</label>
                                    <input type="text" id="bio" name="bio" class="form-control"
                                        placeholder="نبذة" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="address" class="mr-1 control-label">العنوان</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="العنوان" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <label for="city" class="mr-1 control-label">المدينة</label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        placeholder="المدينة" aria-label="name" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <input type="text" class="form-control" placeholder="lat" name="lat"
                                        id="lat">
                                </div>
                                <div class="form-group col-6 mb-3">
                                    <input type="text" class="form-control" placeholder="lng" name="lng"
                                        id="lng">
                                </div>
                                <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

                                <script>
                                    let map;
                                    let latitude;
                                    let longitude;

                                    function initMap() {
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(showPosition);
                                        }

                                        function showPosition(position) {
                                            latitude = position.coords.latitude;
                                            longitude = position.coords.longitude;
                                            map = new google.maps.Map(document.getElementById("map"), {


                                                center: {
                                                    lat: latitude,
                                                    lng: longitude
                                                },
                                                zoom: 8,
                                                scrollwheel: true,
                                            });

                                            const uluru = {
                                                lat: latitude,
                                                lng: longitude
                                            };
                                            let marker = new google.maps.Marker({
                                                position: uluru,
                                                map: map,
                                                draggable: true
                                            });

                                            google.maps.event.addListener(marker, 'position_changed',
                                                function() {
                                                    let lat = marker.position.lat()
                                                    let lng = marker.position.lng()
                                                    $('#lat').val(lat)
                                                    $('#lng').val(lng)
                                                })

                                            google.maps.event.addListener(map, 'click',
                                                function(event) {
                                                    pos = event.latLng
                                                    marker.setPosition(pos)
                                                })
                                        }


                                    }
                                </script>

                                <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
                            </div>
                            <div class="text-left mt-5">
                                <button type="submit" class="btn btn-md btn-primary">حفظ</button>
                                <a href="{{ route('show hospitals') }}" class="btn btn-md btn-secondary">الغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
