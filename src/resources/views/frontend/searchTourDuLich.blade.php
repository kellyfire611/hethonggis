@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
            <div class="banner-content col-lg-8 col-md-12">
                <h4 class="text-white text-uppercase">Có nhiều sự lựa chọn về Du lịch?</h4>
                <h1>
                    Kanto Tourist Cung cấp các Địa điểm Du lịch nổi tiếng			
                </h1>
                <p class="text-white">
                    Cùng khám phá các Địa điểm Du lịch nổi tiếng <br> ở gần ngay bên bạn mà bạn chưa biết đến?.
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
					<option value="tentourdulich" {{ $inputs['type_search'] == 'tentourdulich' ? 'selected' : '' }}>Tên tour du lịch</option>
					<option value="tendiadiem" {{ $inputs['type_search'] == 'tendiadiem' ? 'selected' : '' }}>Tên địa điểm tham quan</option>
					<option value="tendacsan" {{ $inputs['type_search'] == 'tendacsan' ? 'selected' : '' }}>Tên đặc sản</option>
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
					<h1 class="mb-10">Có {{ $tourdulichs->count() }} Tour Du lịch tìm được</h1>
					<p>Được tuyển chọn với niềm tin yêu tuyệt đối từ Quý khách hàng</p>
				</div>
			</div>
		</div>						
		<div class="row">
			@if($tourdulichs->count() <= 0)
			<div class="single-dish col">
				<h2><i class="fas fa-sad-tear"></i> Xin lỗi, không tìm thấy Tour du lịch nào phù hợp với yêu cầu!</h2>
			</div>
			@else
			@foreach($tourdulichs as $tourdulich)
						<div class="single-dish col-lg-3">
							<div class="thumb box-ratio">
                                <div class="box-ratio-content">
									<a href="{{ route('frontend.tourdulich.show', ['tourdulich' => $tourdulich->id]) }}">
										<img class="img-fluid" src="{{ asset('storage/'.$tourdulich->hinhanh) }}" alt="">
                                    </a>
                                </div>
                            </div>
							<h4 class="text-uppercase pt-10"><a href="{{ route('frontend.tourdulich.show', ['tourdulich' => $tourdulich->id]) }}">{{ $tourdulich->tentourdulich }}</a></h4>
							<p>
							Từ: <b>{{ $tourdulich->diemkhoihanh_ten }}</b> - Đến: <b>{{ $tourdulich->diemden_ten }}</b>
							<input type="number" class="rating" value="{{ $tourdulich->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
								Giá người lớn: {{ $tourdulich->giatour_nguoilon }} <br />
								Giá trẻ em: {{ $tourdulich->giatour_treem }}
							</p>
						</div>
                        @endforeach
			@endif
		</div>
	</div>	
</section>
<!-- End top-dish Area -->
@endsection
