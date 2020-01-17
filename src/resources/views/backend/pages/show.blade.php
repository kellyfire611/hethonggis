@extends('backend.layouts.app')

@section('title', 'Quản lý Trang' . ' | ' . 'Xem')

@section('breadcrumb-links')
    @include('backend.pages.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Quản lý Trang
                    <small class="text-muted">Xem Trang</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Tiêu đề</th>
                        <td>{{ $page->title }}</td>
                    </tr>
                    <tr>
                        <th>Đường dẫn trang</th>
                        <td>{{ $page->slug }}</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{!! $page->content !!}</td>
                    </tr>
                    <tr>
                        <th>Từ khóa</th>
                        <td>{{ $page->keyword }}</td>
                    </tr>
                </table>
            </div>
        </div><!--table-responsive-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
