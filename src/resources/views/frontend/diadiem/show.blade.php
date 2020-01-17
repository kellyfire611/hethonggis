@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
<style>
  #map {
    height: 100%;
  }
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
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
                    <h2 class="text-white">{{ $diadiem->tendiadiem }}</h2>
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
            <li>Email: {{ $diadiem->email }}</li>
            <li>Điện thoại: {{ $diadiem->dienthoai }}</li>
            <li>Hoạt động từ: {{ $diadiem->giomocua }}-{{ $diadiem->giodongcua }}</li>
            <li>
                <input type="number" class="rating" value="{{ $diadiem->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
            </li>
        </ul>
        {!! $diadiem->gioithieu !!}
    </div>
</section>
<!-- End Sample Area -->
<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container">
    <div class="section-top-border">
    <h3 class="mb-10">Danh sách dịch vụ</h3>
    <div class="table-responsive">  
        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <th style="width: 35px;">#</th>
                <th style="width: 175px;">Ảnh đại diện</th>
                <th>Tên dịch vụ</th>
                <th>Mô tả ngắn</th>
                <th style="width: 100px;">Giá tiền</th>
            </tr>
            <?php
            $i = 1;
            ?>
            @foreach($diadiem->dichvus as $dichvu)
            <tr>
                <td>{{ $i }}</td>
                <td><img class="img-thumbnail img-table-dichvu" src="{{ asset('storage/'.$dichvu->anhdaidien) }}" alt="{{ $dichvu->tendichvu }}"></td>
                <td>{{ $dichvu->tendichvu }}</td>
                <td>{{ $dichvu->motangan }}</div>
                <td style="text-align: right;">{{ $dichvu->gia }}</div>
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

        <div class="section-top-border">
            <h3>Địa chỉ</h3>
            <div class="row">
                <div class="col">
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $diadiem->GPS }}&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>NenTang: <a href="https://nentang.vn">nentang.vn</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
                </div>
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
            {{ html()->form('POST', route('frontend.diadiem.goidanhgia', ['diadiem' => $diadiem->_id]))->class('form-horizontal quill-form border p-2')->open() }}
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
