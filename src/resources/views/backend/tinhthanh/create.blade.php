@extends('backend.layouts.app')

@section('title', 'Quản lý Tỉnh thành' . ' | ' . 'Thêm mới Tỉnh thành')

@section('breadcrumb-links')
    @include('backend.tinhthanh.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.tinhthanh.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Quản lý Tỉnh thành
                            <small class="text-muted">Thêm mới</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Tên tỉnh thành')->class('col-md-2 form-control-label')->for('tentinhthanh') }}

                            <div class="col-md-10">
                                {{ html()->textarea('tentinhthanh')
                                    ->class('form-control')
                                    ->placeholder('Tên tỉnh thành')
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
                        {{ form_cancel(route('admin.tinhthanh.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}


    
@endsection
