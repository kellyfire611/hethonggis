@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}" />
<style>
  #map {
    height: 100%;
  }
  html, body {
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
<section class="generic-banner relative" style="background: url('{{ asset('storage/'.$diadiem->anhdaidien) }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">						
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="generic-banner-content">
                    <h2 class="text-white">{!! $diadiem->tendiadiem !!}</h2>
                    <p class="text-white">{{ $diadiem->motangan }}</p>
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
            <li>Mã địa điểm: <b>{{ $diadiem->madiemthamquan }}</b></li>
            <li>Tên địa điểm: <b>{!! $diadiem->tendiadiem !!}</b></li>
            <li>
                <input type="number" class="rating" value="{{ $diadiem->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
            </li>
        </ul>
        {!! $diadiem->motangan !!}
    </div>
</section>
<!-- End Sample Area -->
<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container">
    <div class="section-top-border">
    <h3 class="mb-10">Danh sách Đặc sản</h3>
    <div class="table-responsive">  
        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <th style="width: 35px;">#</th>
                <th style="width: 175px;">Ảnh đại diện</th>
                <th>Tên đặc sản</th>
                <th>Mô tả ngắn</th>
            </tr>
            <?php
            $i = 1;
            ?>
            @foreach($diadiem->dacsans as $dacsan)
            <tr>
                <td>{{ $i }}</td>
                <td><img class="img-thumbnail img-table-dacsan" src="{{ asset('storage/'.$dacsan->hinhanh) }}" alt="{{ $dacsan->tendacsan }}"></td>
                <td>{{ $dacsan->tendacsan }}</td>
                <td>{{ $dacsan->mota }}</div>
            </tr>
            <?php
            $i++;
            ?>
            @endforeach
        </table>  
    </div>
</div>

        <div class="section-top-border">
            <h3>Ảnh trưng bày</h3>
            <div class="row gallery-item">
                @foreach($diadiem->dichvus as $dichvu)
                <div class="col-md-4">
                    <a href="{{ asset('storage/'.$dichvu->anhdaidien) }}" class="img-pop-up"><div class="single-gallery-image" style="background: url({{ asset('storage/'.$dichvu->anhdaidien) }});"></div></a>
                </div>
                @endforeach
            </div>
        </div>

        <section class="map">
    <div class="container">
        <div id="mapid"></div>
    </div>
</section>


        <div class="section-top-border">
            @if($diadiem->danhgias->count() > 0)
            <h3>Đánh giá</h3>
            @foreach($diadiem->danhgias as $danhgia)
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
            {{ html()->form('POST', route('frontend.diadiem.goidanhgia', ['diadiem' => $diadiem->id]))->class('form-horizontal quill-form border p-2')->open() }}
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Số điểm')->class('col-md-2 form-control-label')->for('diem') }}
                        <div class="col-md-10">
                            <input id="diem" name="diem" type="number" class="rating" data-step="1" data-size="md" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label('Bình luận')->class('col-md-2 form-control-label')->for('noidung') }}
                        <div class="col-md-10">
                            <input name="noidung" type="hidden">
                            <div id="noidung-editor-container"></div>
                        </div><!--col-->
                    </div><!--form-group-->
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
            // initialize Leaflet
            var map = L.map('mapid').setView([{{ $diadiem->GPS }}], 13);

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

            // Add marker các điểm tham quan
        
            @if(!empty($diadiem->GPS))
                var markerTooltipDiemThamQuan = 'Điểm tham quan: <b>{!! $diadiem->tendiadiem !!}</b><br />';
                markerTooltipDiemThamQuan += '<img src="{{ asset('storage/'.$diadiem->anhdaidien) }}" style="width:120px;" /><br />';
                
                @if(!empty($diadiem->dacsans))
                    markerTooltipDiemThamQuan += '<b>Đặc sản nổi tiếng:</b> <br /><ul style="padding: 10px;list-style: disc;">';
                    @foreach($diadiem->dacsans as $dacsan)
                    markerTooltipDiemThamQuan += '<li>{{ $dacsan->tendacsan }}</li>';
                    @endforeach
                    markerTooltipDiemThamQuan += '</ul>';
                @endif
                
                var pointDiaDiem = new L.LatLng({{ $diadiem->GPS }});
                L.marker(pointDiaDiem, {icon: orangeIcon}).bindPopup(markerTooltipDiemThamQuan).addTo(map);
            @endif
        </script>
<script>
    $(document).ready(function(){
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
        $('.quill-form').submit(function () {
            var noidung = document.querySelector('input[name=noidung]');
            noidung.value = editor.root.innerHTML;
        });
});
</script>
@endpush
