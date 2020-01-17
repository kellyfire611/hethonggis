@extends('backend.layouts.app')

@section('title', 'Quản lý Quảng cáo' . ' | ' . 'Xem')

@section('breadcrumb-links')
    @include('backend.quangcaos.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Quản lý Quảng cáo
                    <small class="text-muted">Xem Quảng cáo</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Tên Quảng cáo</th>
                        <td>{{ $quangcao->tenquangcao }}</td>
                    </tr>
                    <tr>
                        <th>Kiểu hiển thị</th>
                        <td>{{ $quangcao->kieu }}</td>
                    </tr>
                    <tr>
                        <th>Ảnh quảng cáo</th>
                        <td><img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" /></td>
                    </tr>
                    <tr>
                        <th>Đường dẫn URL</th>
                        <td>{{ $quangcao->url }}</td>
                    </tr>
                </table>
            </div>
        </div><!--table-responsive-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
