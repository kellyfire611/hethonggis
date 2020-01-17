@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['diadiem_count'] }}</div>
                <div>Địa điểm Ẩm Thực</div>
            </div>
        </div>  
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['dichvu_count'] }}</div>
                <div>Dịch vụ Ẩm Thực</div>
            </div>
        </div>  
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['user_count'] }}</div>
                <div>Khách hàng Đăng ký</div>
            </div>
        </div>  
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['tinhthanh_count'] }}</div>
                <div>Tỉnh thành</div>
            </div>
        </div>  
    </div>
</div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Thống kê</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-6">
                            <h4>TOP 5 Địa điểm được Đánh giá cao nhất</h4>
                            <div class="row">
                            <div class="col-sm-6">
                            <div class="callout callout-warning">
                            <small class="text-muted">Tổng số lượt đánh giá</small>
                            <br>
                            <strong class="h4">{{ $tongsoluotdanhgia }}</strong>
                            <div class="chart-wrapper">
                            <canvas id="sparkline-chart-3" width="100" height="30"></canvas>
                            </div>
                            </div>
                            </div>

                            <div class="col-sm-6">
                            <div class="callout callout-success">
                            <small class="text-muted">Tổng số lượt Bình luận</small>
                            <br>
                            <strong class="h4">{{ $tongsoluotdanhgia }}</strong>
                            <div class="chart-wrapper">
                            <canvas id="sparkline-chart-4" width="100" height="30"></canvas>
                            </div>
                            </div>
                            </div>

                            </div>

                            <hr class="mt-0">
                            @foreach($top5diadiems as $diadiem)
                            <div class="progress-group">
                                <div class="progress-group-header align-items-end">
                                <i class="icon-globe progress-group-icon"></i>
                                <div>{{ $diadiem->tendiadiem }}</div>
                                <div class="ml-auto font-weight-bold mr-2">{{ $diadiem->diemtrungbinh }}</div>
                                <div class="text-muted small">
                                    <input type="number" class="rating" value="{{ $diadiem->diemtrungbinh }}" data-step="1" data-size="xs" data-readonly="true" data-theme="krajee-svg" data-show-clear="false" data-show-caption="true" data-language="vi" />
                                </div>
                                </div>
                                <div class="progress-group-bars">
                                <div class="progress progress-xs">
                                <?php
                                $width = ($diadiem->diemtrungbinh * 100) / 5;
                                ?>
                                <div class="progress-bar {{ $diadiem->diemtrungbinh > 3 ? 'bg-success' : 'bg-danger' }} " role="progressbar" style="width: {{ $width }}%" aria-valuenow="{{ $diadiem->diemtrungbinh }}" aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    
                        <div class="col col-sm-6">
                            <div class="brand-card">
                            <div class="brand-card-header bg-facebook">
                            <i class="fas fa-ad fa-3x" style="color: white;"></i>
                                &nbsp;<h2 style="color: white;">Thống kê Quảng cáo</h1>
                            </div>
                            <div class="brand-card-body">
                            <div>
                            <div class="text-value">{{ $quangcaos->count() }}</div>
                            <div class="text-uppercase text-muted small">Banner quảng cáo</div>
                            </div>
                            <div>
                            <div class="text-value">2</div>
                            <div class="text-uppercase text-muted small">Lượt clicks</div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->

        
    </div><!--row-->
@endsection
