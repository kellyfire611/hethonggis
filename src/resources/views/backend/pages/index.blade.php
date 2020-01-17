@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Quản lý Trang')

@section('breadcrumb-links')
    @include('backend.pages.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ 'Quản lý Trang' }} <small class="text-muted">Danh sách</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pages.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Slug</th>
                            <th>Keyword</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ $page->keyword }}</td>
                                <td>{!! $page->action_buttons !!}</td>
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
                    {!! $pages->total() !!} mẫu tin
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pages->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
