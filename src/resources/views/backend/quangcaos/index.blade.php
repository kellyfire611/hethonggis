@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Quản lý Quảng cáo')

@section('breadcrumb-links')
    @include('backend.quangcaos.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ 'Quản lý Quảng cáo' }} <small class="text-muted">Danh sách</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.quangcaos.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tên quảng cáo</th>
                            <th>Kiểu</th>
                            <th>Ảnh đại diện</th>
                            <th>Đường dẫn URL</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quangcaos as $quangcao)
                            <tr>
                                <td>{{ $quangcao->tenquangcao }}</td>
                                <td>{{ $quangcao->kieu }}</td>
                                <td style="width: 50%;"><img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" class="img-fluid" /></td>
                                <td>{{ $quangcao->url }}</td>
                                <td>{!! $quangcao->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $quangcaos->total() !!} mẫu tin
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $quangcaos->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
