@extends('backend.layouts.app')

@section('title', 'Quản lý Tour du lịch' . ' | ' . __('labels.backend.tourdulich.view'))

@section('breadcrumb-links')
    @include('backend.tourdulich.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Thông tin Tour du lịch
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Ảnh đại diện</th>
                        <td>
                            <img src="{{ asset('storage/'.$tourdulich->hinhanh) }}" style="width: 100px; height:100px;" />
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Mã Tour du lịch</th>
                        <td>{!! $tourdulich->matourdulich !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tên Tour du lịch</th>
                        <td>{!! $tourdulich->tentourdulich !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Giá tour người lớn</th>
                        <td>{!! $tourdulich->giatour_nguoilon !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Giá tour Trẻ em</th>
                        <td>{!! $tourdulich->giatour_treem !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tên Điểm khởi hành</th>
                        <td>{!! $tourdulich->diemkhoihanh_ten !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tên Quận huyện khởi hành</th>
                        <td>{!! $tourdulich->diemkhoihanhquanhuyen->NAME_2 !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tọa độ khởi hành</th>
                        <td>{!! $tourdulich->diemkhoihanh_toado_string !!}</td>
                    </tr>
                    
                    <tr>
                        <th style="width: 20%;">Tên Điểm đến</th>
                        <td>{!! $tourdulich->diemden_ten !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tên Quận huyện dến</th>
                        <td>{!! $tourdulich->diemdenquanhuyen->NAME_2 !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Tọa độ đến</th>
                        <td>{!! $tourdulich->diemden_toado_string !!}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%;">Số ngày Tour</th>
                        <td>{!! $tourdulich->songaytour !!}</td>
                    </tr>
                    
                </table>
            </div>
        </div><!--table-responsive-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
