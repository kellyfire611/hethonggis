@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
@if(!$page)
<div class="container">
<h1>Không tìm thấy trang!</h1>
</div>
@else
<!-- Start banner Area -->
<section class="generic-banner relative" style="background: url('{{ asset('restaurant/img/header-bg-food-1.jpg') }}'); background-position: center; background-repeat: no-repeat; background-size: cover;">						
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="generic-banner-content">
                    <h2 class="text-white">Giới thiệu</h2>
                    <p class="text-white"></p>
                </div>
            </div>
        </div>
    </div>
</section>		
<!-- End banner Area -->
<!-- Start Sample Area -->
<section class="sample-text-area">
    <div class="container">
        <h3 class="text-heading">Giới thiệu</h3>
        {!! $page->content !!}
    </div>
</section>
<!-- End Sample Area -->
@endif
@endsection
