@extends('backend.layouts.app')

@section('title', 'Quản lý Tour du lịch' . ' | ' . 'Thêm mới')

@section('breadcrumb-links')
    @include('backend.tourdulich.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.tourdulich.store'))->class('form-horizontal quill-form')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Thêm mới Tour du lịch
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label("Mã Tour du lịch")->class('col-md-2 form-control-label')->for('matourdulich') }}
                            <div class="col-md-10">
                                {{ html()->text('matourdulich')
                                    ->class('form-control')
                                    ->placeholder("Nhập mã Tour du lịch")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Tên Tour du lịch")->class('col-md-2 form-control-label')->for('tentourdulich') }}
                            <div class="col-md-10">
                                {{ html()->text('tentourdulich')
                                    ->class('form-control')
                                    ->placeholder("Nhập tên Tour du lịch")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Ảnh đại diện')->class('col-md-2 form-control-label')->for('hinhanh') }}
                            <div class="col-md-10">
                                <div class="kv-avatar text-center">
                                    <div class="file-loading">
                                        <input id="hinhanh-file" name="hinhanh_file" type="file" required>
                                    </div>
                                </div>
                                <div class="kv-avatar-hint"><small>Chọn file có kích cỡ < 1500 KB</small></div>
                                <div id="kv-avatar-errors-hinhanh-file" class="center-block" style="display:none"></div>
                            </div>
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label("Giá tour người lớn")->class('col-md-2 form-control-label')->for('giatour_nguoilon') }}
                            <div class="col-md-10">
                                {{ html()->text('giatour_nguoilon')
                                    ->class('form-control')
                                    ->placeholder("Giá tour người lớn")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Giá tour trẻ em")->class('col-md-2 form-control-label')->for('giatour_treem') }}
                            <div class="col-md-10">
                                {{ html()->text('giatour_treem')
                                    ->class('form-control')
                                    ->placeholder("Giá tour trẻ em")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Tên điểm khởi hành")->class('col-md-2 form-control-label')->for('diemkhoihanh_ten') }}
                            <div class="col-md-10">
                                {{ html()->text('diemkhoihanh_ten')
                                    ->class('form-control')
                                    ->placeholder("Tên điểm khởi hành")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Quận huyện Khởi hành')->class('col-md-2 form-control-label')->for('diemkhoihanh_id_quanhuyen') }}
                            <div class="col-md-10">
                                <select class="form-control" id="diemkhoihanh_id_quanhuyen" name="diemkhoihanh_id_quanhuyen">
                                    @foreach($quanhuyens as $quanhuyen)
                                    <option value="{{ $quanhuyen->ID_2 }}">{{ $quanhuyen->NAME_1 }} - {{ $quanhuyen->NAME_2 }}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Tọa độ điểm khởi hành")->class('col-md-2 form-control-label')->for('diemkhoihanh_toado_string') }}
                            <div class="col-md-10">
                                {{ html()->text('diemkhoihanh_toado_string')
                                    ->class('form-control')
                                    ->placeholder("Tọa độ điểm khởi hành")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Tên điểm đến")->class('col-md-2 form-control-label')->for('diemden_ten') }}
                            <div class="col-md-10">
                                {{ html()->text('diemden_ten')
                                    ->class('form-control')
                                    ->placeholder("Tên điểm đến")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Quận huyện Đến')->class('col-md-2 form-control-label')->for('diemden_id_quanhuyen') }}
                            <div class="col-md-10">
                                <select class="form-control" id="diemden_id_quanhuyen" name="diemden_id_quanhuyen">
                                    @foreach($quanhuyens as $quanhuyen)
                                    <option value="{{ $quanhuyen->ID_2 }}">{{ $quanhuyen->NAME_1 }} - {{ $quanhuyen->NAME_2 }}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label("Tọa độ điểm đến")->class('col-md-2 form-control-label')->for('diemden_toado_string') }}
                            <div class="col-md-10">
                                {{ html()->text('diemden_toado_string')
                                    ->class('form-control')
                                    ->placeholder("Tọa độ điểm đến")
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Số ngày Tour')->class('col-md-2 form-control-label')->for('songaytour') }}
                            <div class="col-md-10">
                                {{ html()->text('songaytour')
                                    ->class('form-control')
                                    ->placeholder('Số ngày tour')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                    </div><!--col-->
                </div><!--row-->

                <!-- <div class="row">
                    <div class="col-sm-5">
                        <h5 class="card-title mb-0">
                            Chi tiết Dịch vụ
                        </h5>
                    </div>
                </div> -->

                <hr>

                <!-- <div id="dynamic_field">
                    <input type="hidden" name="dichvu_chitiet_deleted" />
                    <div class="row mt-4 mb-4">
                        <div id="dynamic-row" class="col">
                            <div class="row border-bottom">
                                <div class="col col-md-3 text-center">
                                    <div class="kv-avatar text-center">
                                        <div class="file-loading">
                                            <input id="dichvu-hinhanh-file-0" name="dichvu_hinhanh_file[]" type="file" required>
                                        </div>
                                    </div>
                                    <div class="kv-avatar-hint"><small>Chọn file có kích cỡ < 1500 KB</small></div>
                                    <div id="kv-avatar-errors-dichvu-hinhanh-file" class="center-block" style="display:none"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" name="dichvu_tendichvu[]" id="dichvu-tendichvu-0" placeholder="Tên dịch vụ" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <input type="text" name="dichvu_motangan[]" id="dichvu-motangan-0" placeholder="Mô tả ngắn" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <input type="number" name="dichvu_gia[]" id="dichvu-gia-0" placeholder="Giá" cleave-auto-unmask="true" class="form-control input-element-number number" />
                                        </div>
                                        <div class="col col-md-auto">
                                            <button type="button" name="add" id="add" class="btn btn-success">+</button>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" name="dichvu_gioithieu[]" id="dichvu-gioithieu-0" placeholder="Giới thiệu" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.tourdulich.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

<!-- dynamic row template -->
@include('backend.tourdulich.includes.dynamic-row-template')

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
        // var editor = new Quill('#gioithieu-editor-container', {
        //     modules: {
        //         toolbar: toolbarOptions
        //     },
        //     theme: 'snow'
        // });
        // editor.container.style.height = '300px';
        // $('.quill-form').submit(function () {
        //     var gioithieu = document.querySelector('input[name=gioithieu]');
        //     gioithieu.value = editor.root.innerHTML;
        // });

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
            $(`#dichvu-hinhanh-file-${i}`).fileinput(hinhanh_file_options);

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
        var hinhanh_file_options = {
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
            elErrorContainer: '#kv-avatar-errors-hinhanh-file',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="'+defaultImg+'" alt="No image" style="width:auto;height:auto;max-width:100%;max-height:100%;"><h6 class="text-muted">Click để chọn ảnh</h6>',
            //layoutTemplates: {main2: '{preview} {remove}'},
            allowedFileExtensions: ["jpg", "png", "gif"],
        };
        $("#hinhanh-file").fileinput(hinhanh_file_options);

        // Dịch vụ Ảnh đại diện
        $(`#dichvu-hinhanh-file-0`).fileinput(hinhanh_file_options);
});
</script>
@endpush
