@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}" />

<style>
    #map {
        height: 100%;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #mapid {
        height: 500px;
    }
</style>
@endpush

@section('content')
<!-- Start banner Area -->
<section class="generic-banner relative" style="background: url('{{ asset('storage/'.$tourdulich->hinhanh) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="generic-banner-content">
                    <h2 class="text-white">{{ $tourdulich->tentourdulich }}</h2>
                    <p class="text-white">{{ $tourdulich->motangan }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
<!-- Start Sample Area -->
<section class="sample-text-area">
    <div class="container">
        <h3 class="text-heading">Giới thiệu</h3>
        <ul>
            <li>Tên Tour: {{ $tourdulich->tentourdulich }}</li>
            <li>Từ: <b>{{ $tourdulich->diemkhoihanh_ten }}</b> - Đến: <b>{{ $tourdulich->diemden_ten }}</b></li>
            <li>
                Giá người lớn: {{ $tourdulich->giatour_nguoilon }} <br />
                Giá trẻ em: {{ $tourdulich->giatour_treem }}
            </li>
            <li>
                <input type="number" class="rating" value="{{ $tourdulich->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
            </li>
        </ul>
        {!! $tourdulich->gioithieu !!}
    </div>
</section>
<!-- End Sample Area -->

<section class="map">
    <div class="container">
        <div id="mapid"></div>
    </div>
</section>


<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container">
        <div class="section-top-border">
            <h3 class="mb-10">Danh sách Điểm tham quan</h3>
            <div class="row">
                @foreach($tourdulich->diemthamquans as $diadiem)
                <div class="single-dish col-lg-3">
                    <div class="thumb box-ratio">
                        <div class="box-ratio-content">
                            <a href="{{ route('frontend.diadiem.show', ['diadiem' => $diadiem->id]) }}">
                                <img class="img-fluid" src="{{ asset('storage/'.$diadiem->anhdaidien) }}" alt="">
                            </a>
                        </div>
                    </div>
                    <h4 class="text-uppercase pt-10"><a href="{{ route('frontend.diadiem.show', ['diadiem' => $diadiem->id]) }}">{{ $diadiem->tendiadiem }}</a></h4>
                    <p>
                        <input type="number" class="rating" value="{{ $diadiem->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                        {{ $diadiem->motangan }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="section-top-border">
            <h3>Địa chỉ</h3>
            <div class="row">
                <div class="col">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $tourdulich->GPS }}&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>NenTang: <a href="https://nentang.vn">nentang.vn</a></div>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 100%;
                            }

                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 100%;
                            }
                        </style>
                    </div>
                </div>
            </div>
            </section>

            <div class="section-top-border">
                @if($tourdulich->danhgias->count() > 0)
                <h3>Đánh giá</h3>
                @foreach($tourdulich->danhgias as $danhgia)
                <div class="row">
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col pull-left text-left">
                                {{ $danhgia->email }}
                            </div>
                            <div class="col pull-right text-right">
                                <input type="number" class="rating" value="{{ $danhgia->diem }}" data-readonly="true" data-step="1" data-size="xs" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {!! $danhgia->noidung !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                <h3>Đánh giá của bạn</h3>
                @guest
                <div class="row">
                    <div class="col">
                        <h2>Vui lòng đăng nhập trước khi Đánh giá!</h2>
                        <a href="{{route('frontend.auth.login')}}" class="btn btn-primary {{ active_class(Active::checkRoute('frontend.auth.login')) }}">Đăng nhập</a>
                    </div>
                </div>
                @endguest

                @auth
                {{ html()->form('POST', route('frontend.tourdulich.goidanhgia', ['tourdulich' => $tourdulich->id]))->class('form-horizontal quill-form border p-2')->open() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Số điểm')->class('col-md-2 form-control-label')->for('diem') }}
                            <div class="col-md-10">
                                <input id="diem" name="diem" type="number" class="rating" data-step="1" data-size="md" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                            </div>
                            <!--col-->
                        </div>
                        <!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Bình luận')->class('col-md-2 form-control-label')->for('noidung') }}
                            <div class="col-md-10">
                                <input name="noidung" type="hidden">
                                <div id="noidung-editor-container"></div>
                            </div>
                            <!--col-->
                        </div>
                        <!--form-group-->
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form_submit('Gởi đánh giá') }}
                    </div>
                </div>
                {{ html()->form()->close() }}
                @endauth
                </section>
            </div>
        </div>



        <!-- End Align Area -->
        @endsection

        @push('after-scripts')
        <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
        <script>
            // var mymap = L.map('mapid').setView([51.505, -0.09], 13);
            // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //     maxZoom: 18,
            //     id: 'mapbox/streets-v11',
            //     accessToken: 'your.mapbox.access.token'
            // }).addTo(mymap);

            // initialize Leaflet
            var map = L.map('mapid').setView([{{ $tourdulich->diemkhoihanh_toado_string }}], 13);

            // Setting custom icon
            var LeafIcon = L.Icon.extend({
                options: {
                    shadowUrl: '{{ asset('vendor/leaflet/images/leaf-shadow.png') }}',
                    iconSize:     [38, 95], // size of the icon
                    shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                }
            });
            var greenIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-green.png') }}'}),
                redIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-red.png') }}'}),
                orangeIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-orange.png') }}'});

            // add the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
            }).addTo(map);

            // show the scale bar on the lower left corner
            L.control.scale().addTo(map);

            
            var pointKhoiDau = new L.LatLng({{ $tourdulich->diemkhoihanh_toado_string }});
            var pointKetThuc = new L.LatLng({{ $tourdulich->diemden_toado_string }} );

            // ---------- MARKER Bắt đầu
            var markerTooltipTour = 'Tour du lịch: {{ $tourdulich->tentourdulich }}</br>Khởi hành từ: <b>{{ $tourdulich->diemkhoihanh_ten }}</b> - Đến: <b>{{ $tourdulich->diemden_ten }}</b>';
            // show a marker on the map
            L.marker(pointKhoiDau, {icon: greenIcon}).bindPopup(markerTooltipTour).addTo(map);

            // ---------- MARKER Kết thúc
            L.marker(pointKetThuc, {icon: redIcon}).bindPopup(markerTooltipTour).addTo(map);

            // Vẽ đường nối 2 điểm
            var pointList = [pointKhoiDau, pointKetThuc];

            var firstpolyline = new L.polyline(pointList, {
                color: 'red',
                weight: 3,
                opacity: 0.5,
                smoothFactor: 1
            });
            firstpolyline.addTo(map);
        </script>

        <script>
            $(document).ready(function() {
                var toolbarOptions = [
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    ['blockquote', 'code-block'],

                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }], // custom button values
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }], // superscript/subscript
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }], // outdent/indent
                    [{
                        'direction': 'rtl'
                    }], // text direction

                    [{
                        'size': ['small', false, 'large', 'huge']
                    }], // custom dropdown
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],

                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // dropdown with defaults from theme
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],

                    ['clean'], // remove formatting button
                    ['link', 'image', 'video']
                ];
                var editor = new Quill('#noidung-editor-container', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow'
                });
                editor.container.style.height = '150px';
                $('.quill-form').submit(function() {
                    var noidung = document.querySelector('input[name=noidung]');
                    noidung.value = editor.root.innerHTML;
                });
            });
        </script>
        @endpush