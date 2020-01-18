@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Quản lý Tour du lịch')

@section('breadcrumb-links')
    @include('backend.tourdulich.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Danh sách tour du lịch
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.tourdulich.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Mã tour du lịch</th>
                            <th>Tên tour du lịch</th>
                            <th>Điểm khởi hành</th>
                            <th>Điểm đến</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tourdulichs as $tourdulich)
                            <tr>
                                <td><img src="{{ asset('storage/'.$tourdulich->hinhanh) }}" style="width: 100px; height:100px;" /></td>
                                <td>{!! $tourdulich->matourdulich !!}</td>
                                <td>{!! $tourdulich->tentourdulich !!}</td>
                                <td>{!! $tourdulich->diemkhoihanhquanhuyen->NAME_2 !!}</td>
                                <td>{!! $tourdulich->diemdenquanhuyen->NAME_2 !!}</td>
                                <td>{!! $tourdulich->action_buttons !!}</td>
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
                    {!! $tourdulichs->total() !!} {{ trans_choice('Tour du lịch', $tourdulichs->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $tourdulichs->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
