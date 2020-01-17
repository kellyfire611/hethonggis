@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
            <div class="banner-content col-lg-8 col-md-12">
                <h4 class="text-white text-uppercase">Có nhiều sự lựa chọn về Ẩm thực?</h4>
                <h1>
                    FEEDY Cung cấp các Địa điểm Ẩm thực nổi tiếng			
                </h1>
                <p class="text-white">
                    Cùng khám phá các Địa điểm Ẩm thực nổi tiếng <br> ở gần ngay bên bạn mà bạn chưa biết đến?.
                </p>
                <a href="#" class="primary-btn header-btn text-uppercase">KHÁM PHÁ NGAY</a>
            </div>												
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- search banner Area -->
{{ html()->form('POST', route('frontend.search'))->class('form-horizontal')->open() }}
<section class="search-area p-2" id="search-area">
    <div class="container">
        <div class="row align-items-center justify-content-start">
			<div class="col col-md-2">
				<select class="form-control" name="type_search">
					<option value="tendiadiem" {{ $inputs['type_search'] == 'tendiadiem' ? 'selected' : '' }}>Tên địa điểm</option>
					<option value="tentinhthanh" {{ $inputs['type_search'] == 'tentinhthanh' ? 'selected' : '' }}>Tên tỉnh thành</option>
					<option value="giatien" {{ $inputs['type_search'] == 'giatien' ? 'selected' : '' }}>Giá tiền</option>
				</select>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa để tìm kiếm" value="{{ $inputs['keyword'] }}" />
			</div>
			<button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</section>
{{ html()->form()->close() }}
<!-- End search Area -->

<!-- Start top-dish Area -->
<section class="top-dish-area section-gap" id="dish">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content col-lg-8">
				<div class="title text-center">
					<h1 class="mb-10">Có {{ $diadiems->count() }} địa điểm Ẩm thực tìm được</h1>
					<p>Được tuyển chọn với niềm tin yêu tuyệt đối từ Thực khách</p>
				</div>
			</div>
		</div>						
		<div class="row">
			@if($diadiems->count() <= 0)
			<div class="single-dish col">
				<h2><i class="fas fa-sad-tear"></i> Xin lỗi, không tìm thấy Địa điểm nào phù hợp với yêu cầu!</h2>
			</div>
			@else
			@foreach($diadiems as $diadiem)
			<div class="single-dish col-lg-3">
				<div class="thumb box-ratio">
					<div class="box-ratio-content">
						<a href="{{ route('frontend.diadiem.show', ['diadiem' => $diadiem->_id]) }}">
							<img class="img-fluid" src="{{ asset('storage/'.$diadiem->anhdaidien) }}" alt="">
						</a>
					</div>
				</div>
				<h4 class="text-uppercase pt-10"><a href="{{ route('frontend.diadiem.show', ['diadiem' => $diadiem->_id]) }}">{{ $diadiem->tendiadiem }}</a></h4>
				<p>
					{{ $diadiem->motangan }}
				</p>
			</div>
			@endforeach
			@endif
		</div>
	</div>	
</section>
<!-- End top-dish Area -->
@endsection
