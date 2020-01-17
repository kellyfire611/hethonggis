@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Quản lý Tỉnh thành')

@section('breadcrumb-links')
    @include('backend.tinhthanh.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ 'Quản lý Tỉnh thành' }} <small class="text-muted">{{ 'Danh sách' }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.tinhthanh.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tên tình thành</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tinhthanhs as $tinhthanh)
                            <tr>
                                <td>{{ $tinhthanh->tentinhthanh }}</td>
                                <td>{!! $tinhthanh->action_buttons !!}</td>
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
                    {!! $tinhthanhs->total() !!} {{ trans_choice('mẫu tin', $tinhthanhs->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $tinhthanhs->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
