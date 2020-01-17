@extends('backend.layouts.app')

@section('title', 'Quản lý Quảng cáo' . ' | ' . 'Thêm mới Quảng cáo')

@section('breadcrumb-links')
    @include('backend.quangcaos.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.quangcaos.store'))->class('form-horizontal quill-form')->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Quản lý Quảng cáo
                            <small class="text-muted">Thêm mới Quảng cáo</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Tên quảng cáo')->class('col-md-2 form-control-label')->for('tenquangcao') }}
                            <div class="col-md-10">
                                {{ html()->text('tenquangcao')
                                    ->class('form-control')
                                    ->placeholder('Tên quảng cáo')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Kiểu hiển thị')->class('col-md-2 form-control-label')->for('kieu') }}
                            <div class="col-md-10">
                                <select name="kieu" class="form-control">
                                    <option value="horizontal-banner-top">Banner top nằm ngang</option>
                                    <option value="vertical-banner-sidebar">Banner đứng chạy dọc 2 bên</option>
                                    <option value="horizontal-banner-home">Banner nằm ngang trên trang chủ</option>
                                </select>
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
                            {{ html()->label('Đường dẫn URL')->class('col-md-2 form-control-label')->for('url') }}
                            <div class="col-md-10">
                                {{ html()->text('url')
                                    ->class('form-control')
                                    ->placeholder('Đường dẫn URL')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.quangcaos.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}


    
@endsection

@push('after-scripts')
<script>
    $(document).ready(function(){
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
    });
</script>
@endpush
