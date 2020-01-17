@extends('backend.layouts.app')

@section('title', 'Quản lý Địa điểm' . ' | ' . __('labels.backend.diadiem.view'))

@section('breadcrumb-links')
    @include('backend.diadiem.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Thông tin địa điểm
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th style="width: 20%;">Tên địa điểm</th>
                        <td>{{ $diadiem->tendiadiem }}</td>
                    </tr>
                    <tr>
                        <th>Mô tả ngắn</th>
                        <td>{{ $diadiem->motangan }}</td>
                    </tr>
                    <tr>
                        <th>Ảnh đại diện</th>
                        <td>
                            <img src="{{ $anhdaidien_base64 }}" class="img-fluid" style="width:300px;" />
                        </td>
                    </tr>
                    <tr>
                        <th>Từ khóa</th>
                        <td>{{ $diadiem->tukhoa }}</td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td>{{ $diadiem->dienthoai }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $diadiem->email }}</td>
                    </tr>
                    <tr>
                        <th>Giờ mở cửa</th>
                        <td>{{ $diadiem->giomocua }}</td>
                    </tr>
                    <tr>
                        <th>Giờ đóng cửa</th>
                        <td>{{ $diadiem->giodongcua }}</td>
                    </tr>
                    <tr>
                        <th>Tọa độ GPS</th>
                        <td>{{ $diadiem->GPS }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>{{ $diadiem->trangthai }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tại</th>
                        <td>{{ $diadiem->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $diadiem->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>Giới thiệu</th>
                        <td>{!! $diadiem->gioithieu !!}</td>
                    </tr>
                </table>
            </div>
        </div><!--table-responsive-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
