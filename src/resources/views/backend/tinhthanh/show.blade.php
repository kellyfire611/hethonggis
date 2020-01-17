@extends('backend.layouts.app')

@section('title', __('labels.backend.tinhthanh.management') . ' | ' . __('labels.backend.tinhthanh.view'))

@section('breadcrumb-links')
    @include('backend.tinhthanh.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.tinhthanh.management')
                    <small class="text-muted">@lang('labels.backend.tinhthanh.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>@lang('labels.backend.tinhthanh.tentinhthanh')</th>
                        <td>{{ $tinhthanh->tentinhthanh }}</td>
                    </tr>
                </table>
            </div>
        </div><!--table-responsive-->

        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
