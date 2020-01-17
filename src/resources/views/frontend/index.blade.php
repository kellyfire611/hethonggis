@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<!-- start banner ads top -->
<section class="horizontal-banner-top" id="horizontal-banner-top">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
			<div class="owl-carousel owl-theme" id="horizontal-banner-top-slider">
				@foreach($quangcaos->where('kieu', 'horizontal-banner-top') as $quangcao)
				<div>
					<a href="{{ $quangcao->url }}">
						<img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" class="img-fluid"/>
					</a>
				</div>
				@endforeach										
			</div>
        </div>
    </div>
</section>
<!-- End banner ads top -->

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
					<option value="tendiadiem">Tên địa điểm</option>
					<option value="tentinhthanh">Tên tỉnh thành</option>
					<option value="giatien">Giá tiền</option>
				</select>
			</div>
			<div class="col">
				<input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa để tìm kiếm" />
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
				<?php
				$vertical_ads = $quangcaos->where('kieu', 'vertical-banner-sidebar')->take(2);
				?>
				<div class="clearfix">
				@foreach($vertical_ads as $quangcao)
					@if($quangcao == $vertical_ads->first())
					<div class="vertical-banner-sidebar-left">
						<a href="{{ $quangcao->url }}">
							<img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" class="img-fluid"/>
						</a>
					</div>
					@else
					<div class="vertical-banner-sidebar-right">
						<a href="{{ $quangcao->url }}">
							<img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" class="img-fluid"/>
						</a>
					</div>
					@endif
				@endforeach
	
				</div>
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Các địa điểm Ẩm thực hot nhất</h1>
								<p>Được tuyển chọn với niềm tin yêu tuyệt đối từ Thực khách</p>
							</div>
						</div>
					</div>						
					<div class="row">
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
							<input type="number" class="rating" value="{{ $diadiem->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                                {{ $diadiem->motangan }}
							</p>
						</div>
                        @endforeach
					</div>
				</div>	
			</section>
			<!-- End top-dish Area -->

			<!-- start banner ads top -->
			<section class="horizontal-banner-home" id="horizontal-banner-home">
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-start owl-carousel owl-theme" id="horizontal-banner-home-slider">
						@foreach($quangcaos->where('kieu', 'horizontal-banner-home') as $quangcao)
						<div class="col">
							<a href="{{ $quangcao->url }}">
								<img src="{{ asset('storage/'.$quangcao->anhdaidien) }}" class="img-fluid"/>
							</a>
						</div>
						@endforeach
					</div>
				</div>
			</section>
			<!-- End banner ads top -->
			
			<!-- Start video Area -->
			<section class="video-area">
				<div class="container">
					<div class="row justify-content-center align-items-center flex-column">
						<a class="play-btn" href="https://www.youtube.com/watch?v=MflT0I7ZPCs">
							<img src="{{ asset('restaurant/img/play-btn.png') }}" alt="">
						</a>
						<h3 class="pt-20 pb-20 text-white">Chúng tôi luôn cố gắng cung cấp các Địa điểm Ẩm thực với các món ăn tuyệt hảo nhất</h3>
						<p class="text-white">Click vào để xem video Ẩm thực cực bắt mắt</p>
					</div>
				</div>	
			</section>
			<!-- End video Area -->
			

			<!-- Start features Area -->
			<section class="features-area pt-20" id="feature">
				<div class="container">
					<div class="feature-section">
						<div class="row">
							<div class="single-feature col-lg-3 col-md-6">
								<img src="{{ asset('restaurant/img/f1.png') }}" alt="">
								<h4 class="pt-20 pb-20">Bữa sáng NGON LÀNH</h4>
								<p>
									Nạp đầy năng lượng cho buổi sáng làm việc!
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="{{ asset('restaurant/img/f2.png') }}" alt="">
								<h4 class="pt-20 pb-20">Bữa trưa TUYỆT HẢO</h4>
								<p>
									Thưởng thức bữa trưa văn phòng ấm áp cùng Đồng nghiệp!
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="{{ asset('restaurant/img/f3.png') }}" alt="">
								<h4 class="pt-20 pb-20">Bữa tối NGỌT NGÀO</h4>
								<p>
									Lãng mạn, tinh tế cho cặp đôi.
								</p>
							</div>
							<div class="single-feature col-lg-3 col-md-6">
								<img src="{{ asset('restaurant/img/f4.png') }}" alt="">
								<h4 class="pt-20 pb-20">CHẤT LƯỢNG ĐỈNH CAO</h4>
								<p>
									Sống là để hưởng thụ, ăn, uống chất lượng!!!
								</p>
							</div>														
						</div>											
					</div>
				</div>	
			</section>
			<!-- End features Area -->


			<!-- Start related Area -->
			<section class="related-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Các món ăn phổ biến nhất</h1>
								<p>Chúng tôi tận tâm tìm kiếm các món ăn đầy thú vị cho thực khách</p>
							</div>
						</div>
					</div>						
					<div class="row justify-content-center">
						<div class="active-realated-carusel owl-carousel owl-theme">
                            @foreach($topmonans as $monan)
							<div class="item row align-items-center">
								<div class="col-lg-6 rel-left">
								   <h3>
								   		{{ $monan->tendiadiem }}
								   </h3>
								   <p class="pt-30 pb-30">
								 	  	{{ $monan->motangan }}
								   </p>
									<a href="{{ route('frontend.diadiem.show', ['monan' => $monan->_id]) }}" class="primary-btn header-btn text-uppercase">Ghé thăm Địa điểm ngay</a>								   
								</div>
								<div class="col-lg-6 box-ratio">
									<div class="box-ratio-content">
										<img class="img-fluid" src="{{ asset('storage/'.$monan->anhdaidien) }}" alt="">
									</div>
								</div>
                            </div>
                            @endforeach
						</div>
					</div>
				</div>	
			</section>
			<!-- End related Area -->	


			<!-- Start team Area -->
			<section class="team-area section-gap" id="chefs">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Gặp gỡ các Đầu bếp siêu hạng</h1>
								<p>Người đánh giá, kiểm định chất lượng của các Địa điểm Ẩm thực</p>
							</div>
						</div>
					</div>						
					<div class="row justify-content-center d-flex align-items-center">
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="{{ asset('restaurant/img/t1.jpg') }}" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Ethel Davis</h4>
							    <p>Quản lý Nhà Hàng</p>									    	
						    </div>
						</div>
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="{{ asset('restaurant/img/t2.jpg') }}" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Rodney Cooper</h4>
							    <p>Bếp Trưởng</p>			    	
						    </div>
						</div>	
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="{{ asset('restaurant/img/t3.jpg') }}" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Dora Walker</h4>
							    <p>Thợ nấu bếp lâu năm</p>			    	
						    </div>
						</div>	
						<div class="col-md-3 single-team">
						    <div class="thumb">
						        <img class="img-fluid" src="{{ asset('restaurant/img/t4.jpg') }}" alt="">
						        <div class="align-items-center justify-content-center d-flex">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-linkedin"></i></a>
						        </div>
						    </div>
						    <div class="meta-text mt-30 text-center">
							    <h4>Lena Keller</h4>
							    <p>Chuyên gia Bình Luận Ẩm thực</p>			    	
						    </div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End team Area -->			

			<!-- Start Contact Area -->
			<section class="contact-area" id="contact">
				<div class="container-fluid">
					<div class="row align-items-center d-flex justify-content-start">
						<div class="col-lg-6 col-md-12 contact-left no-padding">
							<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Khu%202%20%C4%91%E1%BA%A1i%20h%E1%BB%8Dc%20c%E1%BA%A7n%20th%C6%A1&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>NenTang: <a href="https://nentang.vn">nentang.vn</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
						</div>
						<div class="col-lg-4 col-md-12 pt-100 pb-100">
							<form class="form-area" id="myForm" action="" method="post" class="contact-form text-right">
								<input name="fname" placeholder="Tên của bạn" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên của bạn'" class="common-input mt-10" required="" type="text">
								<input name="email" placeholder="Email của bạn" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email của bạn'" class="common-input mt-10" required="" type="email">
								<textarea class="common-textarea mt-10" name="message" placeholder="Lời nhắn" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lời nhắn'" required=""></textarea>
								<button class="primary-btn mt-20">Gởi lời nhắn đến Feedy<span class="lnr lnr-arrow-right"></span></button>
								<div class="mt-10 alert-msg">
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- End Contact Area -->	

<div>
	
</div>

@endsection

@push('after-scripts')
<script>
	$(document).ready(function(){
		

		$('#horizontal-banner-top-slider').owlCarousel({
			items:1,
			loop:true,
			dots: false,
			nav:false,
			autoplay:true,
			autoplayTimeout: 3000,
			//navText: ["<span class='lnr lnr-arrow-up'></span>", "<span class='lnr lnr-arrow-down'></span>"],        
				responsive: {
				0: {
					items: 1
				},
				480: {
					items: 1,
				},
				768: {
					items: 1,
				},
				900: {
					items: 1,
				}

			}
		});
	});
</script>
@endpush