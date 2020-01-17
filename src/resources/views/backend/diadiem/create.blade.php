@extends('backend.layouts.app')

@section('title', 'Quản lý Địa điểm' . ' | ' . 'Thêm mới')

@section('breadcrumb-links')
    @include('backend.diadiem.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.diadiem.store'))->class('form-horizontal quill-form')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Thêm mới địa điểm
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
                                    ->placeholder("Nhập tên địa điểm")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
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
                                        <input id="anhdaidien-file" name="anhdaidien_file" type="file" required>
                                    </div>
                                </div>
                                <div class="kv-avatar-hint"><small>Chọn file có kích cỡ < 1500 KB</small></div>
                                <div id="kv-avatar-errors-anhdaidien-file" class="center-block" style="display:none"></div>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Địa chỉ')->class('col-md-2 form-control-label')->for('tendiachi') }}
                            <div class="col-md-10">
                                {{ html()->text('tendiachi')
                                    ->class('form-control')
                                    ->placeholder('Địa chỉ')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Tỉnh thành/Quận huyện/Xã phường')->class('col-md-2 form-control-label')->for('tinhthanh') }}
                            <div class="col-md-10">
                                <select name="slTinhThanh" class="form-control">
                                @foreach($diachis as $diachi)
                                <option value="{{ $diachi['all'] }}">{{ $diachi['all'] }}</option>
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
                                <input type="checkbox" name="trangthai" />
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Giới thiệu')->class('col-md-2 form-control-label')->for('gioithieu') }}
                            <div class="col-md-10">
                                <input name="gioithieu" type="hidden">
                                <div id="gioithieu-editor-container"></div>
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

                <hr>

                <div id="dynamic_field">
                <input type="hidden" name="dichvu_chitiet_deleted" />
                <div class="row mt-4 mb-4">
                    <div id="dynamic-row" class="col">
                        <div class="row border-bottom">
                            <div class="col col-md-3 text-center">
                                <div class="kv-avatar text-center">
                                    <div class="file-loading">
                                        <input id="dichvu-anhdaidien-file-0" name="dichvu_anhdaidien_file[]" type="file" required>
                                    </div>
                                </div>
                                <div class="kv-avatar-hint"><small>Chọn file có kích cỡ < 1500 KB</small></div>
                                <div id="kv-avatar-errors-dichvu-anhdaidien-file" class="center-block" style="display:none"></div>
                            </div><!-- col -->
                            <div class="col">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="dichvu_tendichvu[]" id="dichvu-tendichvu-0" placeholder="Tên dịch vụ" class="form-control" />
                                    </div><!--col-->
                                    <div class="col">
                                        <input type="text" name="dichvu_motangan[]" id="dichvu-motangan-0" placeholder="Mô tả ngắn" class="form-control" />
                                    </div><!--col-->
                                    <div class="col">
                                        <input type="number" name="dichvu_gia[]" id="dichvu-gia-0" placeholder="Giá" cleave-auto-unmask="true" class="form-control input-element-number number" />
                                    </div><!--col-->
                                    <div class="col col-md-auto">
                                        <button type="button" name="add" id="add" class="btn btn-success">+</button>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="dichvu_gioithieu[]" id="dichvu-gioithieu-0" placeholder="Giới thiệu" class="form-control" />
                                    </div><!--col-->
                                </div><!--form-group-->
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- col -->
                </div>
            </div>
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.diadiem.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

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
        var i=1;  
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

            // Dịch vụ Ảnh đại diện
            $(`#dichvu-anhdaidien-file-${i}`).fileinput(anhdaidien_file_options);

            i++;
        });  

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#dynamic-row-'+button_id+'').remove();  
        });  

        $(document).on('click', '#add', function(){
            $('.input-element-number').each((i, el) => {
                // var cleave = new Cleave(el, {
                //     numeral: true,
                //     numeralThousandsGroupStyle: 'thousand'
                // });
                $(el).cleave({ numeral: true, numeralThousandsGroupStyle: 'thousand', autoUnmask: true});
            });
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
        };
        $("#anhdaidien-file").fileinput(anhdaidien_file_options);

        // Dịch vụ Ảnh đại diện
        $(`#dichvu-anhdaidien-file-0`).fileinput(anhdaidien_file_options);
});
</script>
@endpush
