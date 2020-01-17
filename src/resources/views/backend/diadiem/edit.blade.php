@extends('backend.layouts.app')

@section('title', 'Quản lý Địa điểm' . ' | ' . 'Sửa')

@section('breadcrumb-links')
    @include('backend.diadiem.includes.breadcrumb-links')
@endsection

@push('after-styles')
@endpush

@section('content')
{{ html()->modelForm($diadiem, 'PATCH', route('admin.diadiem.update', $diadiem->_id))->class('form-horizontal quill-form')->acceptsFiles()->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                       Chỉnh sửa thông tin địa điểm
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label("Tên địa điểm")->class('col-md-2 form-control-label')->for('tendiadiem') }}

                        <div class="col-md-10">
                            {{ html()->text('tendiadiem')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.diadiem.tendiadiem'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                            {{ html()->label("Mô tả ngắn")->class('col-md-2 form-control-label')->for('motangan') }}
                            <div class="col-md-10">
                                {{ html()->text('motangan')
                                    ->class('form-control')
                                    ->placeholder("Mô tả ngắn")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                    <div class="form-group row">
                            {{ html()->label('Ảnh đại diện')->class('col-md-2 form-control-label')->for('anhdaidien') }}
                            <div class="col-md-10">
                                <div class="kv-avatar text-center">
                                    <div class="file-loading">
                                        @if(empty($diadiem->anhdaidien))
                                        <input id="anhdaidien-file" name="anhdaidien_file" type="file" required>
                                        @else
                                        <input id="anhdaidien-file" name="anhdaidien_file" type="file">
                                        @endif
                                    </div>
                                </div>
                                <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
                                <div id="kv-avatar-errors-anhdaidien-file" class="center-block" style="display:none"></div>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Địa chỉ')->class('col-md-2 form-control-label')->for('tendiachi') }}
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="tendiachi" id="tendiachi" value="{{ old('tendiachi', $diadiem->diachi->tendiachi) }}" placeholder="Địa chỉ" maxlength="191" required="">
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Tỉnh thành/Quận huyện/Xã phường')->class('col-md-2 form-control-label')->for('tinhthanh') }}
                            <div class="col-md-10">
                                <select name="slTinhThanh" class="form-control">
                                @foreach($diachis as $diachi)
                                @if($diadiem->diachiedit === $diachi['all'])
                                <option value="{{ $diachi['all'] }}" selected>{{ $diachi['all'] }}</option>
                                @else
                                <option value="{{ $diachi['all'] }}">{{ $diachi['all'] }}</option>
                                @endif
                                @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Từ khóa')->class('col-md-2 form-control-label')->for('tukhoa') }}
                            <div class="col-md-10">
                                {{ html()->text('tukhoa')
                                    ->class('form-control')
                                    ->placeholder('Từ khóa')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Điện thoại')->class('col-md-2 form-control-label')->for('dienthoai') }}
                            <div class="col-md-10">
                                {{ html()->text('dienthoai')
                                    ->class('form-control')
                                    ->placeholder('Điện thoại')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Email')->class('col-md-2 form-control-label')->for('email') }}
                            <div class="col-md-10">
                                {{ html()->text('email')
                                    ->class('form-control')
                                    ->placeholder('Email')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Giờ mở cửa')->class('col-md-2 form-control-label')->for('giomocua') }}
                            <div class="col-md-10">
                                {{ html()->text('giomocua')
                                    ->class('form-control')
                                    ->placeholder('Giờ mở cửa')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Giờ đóng cửa')->class('col-md-2 form-control-label')->for('giodongcua') }}
                            <div class="col-md-10">
                                {{ html()->text('giodongcua')
                                    ->class('form-control')
                                    ->placeholder('Giờ đóng cửa')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('GPS')->class('col-md-2 form-control-label')->for('Tọa độ GPS') }}
                            <div class="col-md-10">
                                {{ html()->text('GPS')
                                    ->class('form-control')
                                    ->placeholder('Tọa độ GPS')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Duyệt')->class('col-md-2 form-control-label')->for('trangthai') }}
                            <div class="col-md-10">
                                @if($diadiem->trangthai == '1')
                                <input type="checkbox" name="trangthai" value="1" checked />
                                @else
                                <input type="checkbox" name="trangthai" value="0" />
                                @endif
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Giới thiệu')->class('col-md-2 form-control-label')->for('gioithieu') }}
                            <div class="col-md-10">
                                <input name="gioithieu" type="hidden">
                                <div id="gioithieu-editor-container">{!! $diadiem->gioithieu !!}</div>
                            </div><!--col-->
                        </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        Chi tiết Dịch vụ
                    </h5>
                </div><!--col-->
            </div><!--row-->

            <div id="dynamic_field">
                <?php
                $i = 0;
                ?>
                @foreach($diadiem->dichvus as $dichvu)
                @if($dichvu == $diadiem->dichvus->first())
                <div class="row border-bottom mt-4" id="dynamic-row-{{ $i }}">
                    <div class="col col-md-3 text-center">
                        @if(!empty($dichvu->anhdaidien))
                        <input type="hidden" name="dichvu_anhdaidien_old_file[]" value="{{ $dichvu->anhdaidien }}"/>
                        @endif
                        <div class="kv-avatar text-center">
                            <div class="file-loading">
                                @if(empty($dichvu->anhdaidien))
                                <input id="dichvu-anhdaidien-file-{{ $i }}" name="dichvu_anhdaidien_file[]" type="file" required>
                                @else
                                <input id="dichvu-anhdaidien-file-{{ $i }}" name="dichvu_anhdaidien_file[]" type="file">
                                @endif
                            </div>
                        </div>
                        <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
                        <div id="kv-avatar-errors-dichvu-anhdaidien-file" class="center-block" style="display:none"></div>
                    </div><!-- col -->
                    <div class="col">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" name="dichvu_tendichvu[]" id="dichvu-tendichvu-{{ $i }}" placeholder="Tên dịch vụ" class="form-control" value="{{ $dichvu->tendichvu }}" />
                            </div><!--col-->
                            <div class="col">
                                <input type="text" name="dichvu_motangan[]" id="dichvu-motangan-{{ $i }}" placeholder="Mô tả ngắn" class="form-control" value="{{ $dichvu->motangan }}" />
                            </div><!--col-->
                            <div class="col">
                                <input type="number" name="dichvu_gia[]" id="dichvu-gia-{{ $i }}" placeholder="Giá" cleave-auto-unmask="true" class="form-control input-element-number number" value="{{ $dichvu->gia }}" />
                            </div><!--col-->
                            <div class="col col-md-auto">
                                <button type="button" name="add" id="add" class="btn btn-success">+</button>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col">
                                <input type="text" name="dichvu_gioithieu[]" id="dichvu-gioithieu-{{ $i }}" placeholder="Giới thiệu" class="form-control" value="{{ $dichvu->gioithieu }}" />
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!-- col -->
                </div><!-- row -->
                @else
                <div class="row border-bottom mt-4" id="dynamic-row-{{ $i }}">
                    <div class="col col-md-3 text-center">
                        @if(!empty($dichvu->anhdaidien))
                        <input type="hidden" name="dichvu_anhdaidien_old_file[]" value="{{ $dichvu->anhdaidien }}"/>
                        @endif
                        <div class="kv-avatar text-center">
                            <div class="file-loading">
                                @if(empty($dichvu->anhdaidien))
                                <input id="dichvu-anhdaidien-file-{{ $i }}" name="dichvu_anhdaidien_file[]" type="file" required>
                                @else
                                <input id="dichvu-anhdaidien-file-{{ $i }}" name="dichvu_anhdaidien_file[]" type="file">
                                @endif
                            </div>
                        </div>
                        <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
                        <div id="kv-avatar-errors-dichvu-anhdaidien-file" class="center-block" style="display:none"></div>
                    </div><!-- col -->
                    <div class="col">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" name="dichvu_tendichvu[]" id="dichvu-tendichvu-{{ $i }}" placeholder="Tên dịch vụ" class="form-control" value="{{ $dichvu->tendichvu }}" />
                            </div><!--col-->
                            <div class="col">
                                <input type="text" name="dichvu_motangan[]" id="dichvu-motangan-{{ $i }}" placeholder="Mô tả ngắn" class="form-control" value="{{ $dichvu->motangan }}" />
                            </div><!--col-->
                            <div class="col">
                                <input type="number" name="dichvu_gia[]" id="dichvu-gia-{{ $i }}" placeholder="Giá" cleave-auto-unmask="true" class="form-control input-element-number number" value="{{ $dichvu->gia }}" />
                            </div><!--col-->
                            <div class="col col-md-auto">
                                <button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove">X</button>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col">
                                <input type="text" name="dichvu_gioithieu[]" id="dichvu-gioithieu-{{ $i }}" placeholder="Giới thiệu" class="form-control" value="{{ $dichvu->gioithieu }}" />
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!-- col -->
                </div><!-- row -->
                @endif
                <?php
                $i++;
                ?>
                @endforeach
            </div>
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.diadiem.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}

<!-- dynamic row template -->
@include('backend.diadiem.includes.dynamic-row-template')

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
        var editor = new Quill('#gioithieu-editor-container', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        editor.container.style.height = '300px';
        $('.quill-form').submit(function () {
            var gioithieu = document.querySelector('input[name=gioithieu]');
            gioithieu.value = editor.root.innerHTML;
        });

        //Dynamic field
        var i={{ $diadiem->dichvus->count() }};  
        $('#add').click(function(){  
            var dichvuRowTemplate = document.getElementById("dichvu-row-template").innerHTML;
            var templateFn = _.template(dichvuRowTemplate);
            var templateHTML = templateFn({
                'index': i,
                'tendichvu': null,
                'motangan': null,
                'gia': null,
                'gioithieu': null
            });
            $('#dynamic_field').append(templateHTML);

            // $('#dichvu-gia-'+i).cleave({ numeral: true, numeralThousandsGroupStyle: 'thousand', autoUnmask: true});

            var anhdaidien_file_options = {
                theme: 'fas',
                overwriteInitial: true,
                maxFileSize: 1500,
                showClose: true,
                showUpload: false,
                showCaption: true,
                //showBrowse: false,
                //browseOnZoneClick: true,
                removeLabel: '',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors-anhdaidien-file',
                msgErrorClass: 'alert alert-block alert-danger',
                defaultPreviewContent: '<img src="'+defaultImg+'" alt="No image" style="width:auto;height:auto;max-width:100%;max-height:100%;"><h6 class="text-muted">Click để chọn ảnh</h6>',
                //layoutTemplates: {main2: '{preview} {remove}'},
                allowedFileExtensions: ["jpg", "png", "gif"],
            };
            $("#dichvu-anhdaidien-file-"+i).fileinput(anhdaidien_file_options);
            i++;
        });  

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#dynamic-row-'+button_id+'').remove();  
        });  

        var defaultImg = "{{ asset('img/'.'default-image-450x450.png') }}";
        var anhdaidien_file_options = {
            theme: 'fas',
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: true,
            showUpload: false,
            showCaption: true,
            //showBrowse: false,
            //browseOnZoneClick: true,
            removeLabel: '',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-anhdaidien-file',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="'+defaultImg+'" alt="No image" style="width:auto;height:auto;max-width:100%;max-height:100%;"><h6 class="text-muted">Click để chọn ảnh</h6>',
            //layoutTemplates: {main2: '{preview} {remove}'},
            allowedFileExtensions: ["jpg", "png", "gif"],
            @if(!empty($diadiem->anhdaidien))
            initialPreview: [
                "<img src='{{ asset('storage/' . $diadiem->anhdaidien) }}' class='file-preview-image kv-preview-data' alt='{{ $diadiem->tendiadiem }}' style='width:auto;height:auto;max-width:100%;max-height:100%;'>",
            ],
            initialPreviewConfig: [
                {
                    caption: "{{ $diadiem->tendiadiem }}", 
                    size: {{ Storage::exists('public/' . $diadiem->anhdaidien) ? Storage::size('public/' . $diadiem->anhdaidien) : 0 }}, 
                    width: "120px", 
                    key: 1
                },
            ],
            @endif
        };
        $("#anhdaidien-file").fileinput(anhdaidien_file_options);

        <?php
        $i=0;
        ?>
        @foreach($diadiem->dichvus as $dichvu)0
        // $('#dichvu-gia-{{ $i }}').cleave({ numeral: true, numeralThousandsGroupStyle: 'thousand', autoUnmask: true});
        $("#dichvu-anhdaidien-file-{{ $i }}").fileinput({
            theme: 'fas',
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            //showBrowse: false,
            //browseOnZoneClick: true,
            removeLabel: '',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-dichvu-anhdaidien-file1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="'+defaultImg+'" alt="No image" style="width:auto;height:auto;max-width:100%;max-height:100%;"><h6 class="text-muted">Click để chọn ảnh</h6>',
            //layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"],
            @if(!empty($dichvu->anhdaidien))
            initialPreview: [
                "<img src='{{ asset('storage/' . $dichvu->anhdaidien) }}' class='file-preview-image kv-preview-data' alt='{{ $dichvu->tendichvu }}' style='width:auto;height:auto;max-width:100%;max-height:100%;'>",
            ],
            initialPreviewConfig: [
                {
                    caption: "{{ $dichvu->tendichvu }}", 
                    size: {{ Storage::exists('public/' . $dichvu->anhdaidien) ? Storage::size('public/' . $dichvu->anhdaidien) : 0 }}, 
                    width: "120px", 
                    key: 1
                },
            ],
            @endif
        });
        <?php
        $i++;
        ?>
        @endforeach
        
        
});
</script>
@endpush
