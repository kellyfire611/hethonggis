@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['diadiem_count'] }}</div>
                <div>Địa điểm Du lịch</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="text-value">{{ $baocaodata['dichvu_count'] }}</div>
                <div>Dịch vụ Du lịch</div>
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
            </div>
            <!--card-header-->
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="col-md-12">
                            <form method="get" action="#" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id_tinhThanh">Chọn tỉnh Thành</label>
                                    <select class="form-control" id="id_tinhThanh" name="id_tinhThanh">
                                        <option value="0">Tất cả</option>
                                        @foreach($tinhthanhs as $tinhthanh)
                                        <option value="{{ $tinhthanh->ID_1 }}">{{ $tinhthanh->NAME_1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btnLapBaoCao">Lập báo cáo</button>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <canvas id="chartOfobjChart" style="width: 100%;height: 400px;"></canvas>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="col col-md-12">

                    </div>
                </div>
            </div>
            <!--card-body-->
        </div>
        <!--card-->
    </div>
    <!--col-->


</div>
<!--row-->
@endsection

@push('after-scripts')
<!-- Các script dành cho thư viện ChartJS -->
<script src="{{ asset('vendor/Chart.js/Chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var objChart;
        var $chartOfobjChart = document.getElementById("chartOfobjChart").getContext("2d");
        $("#btnLapBaoCao").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.baocao.soluongdiemthamquan.data') }}',
                type: "GET",
                data: {
                    idTinhThanh: $('#id_tinhThanh').val(),
                },
                success: function(response) {
                    debugger;
                    var myLabels = [];
                    var myData = [];
                    $(response.data).each(function() {
                        myLabels.push(this.TenTinhThanh);
                        myData.push(this.SoLuong);
                    });
                    myData.push(0); // creates a '0' index on the graph
                    if (typeof $objChart !== "undefined") {
                        $objChart.destroy();
                    }
                    $objChart = new Chart($chartOfobjChart, {
                        // The type of chart we want to create
                        type: "bar",
                        data: {
                            labels: myLabels,
                            datasets: [{
                                data: myData,
                                borderColor: "#9ad0f5",
                                backgroundColor: "#9ad0f5",
                                borderWidth: 1
                            }]
                        },
                        // Configuration options go here
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Báo cáo Số lượng Điểm Tham Quan"
                            },
                            scales: {
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Tên Tỉnh thành'
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        // callback: function(value) {
                                        //     return numeral(value).format('0,0 $')
                                        // }
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Số lượng Điểm Tham quan'
                                    }
                                }]
                            },
                            tooltips: {
                                // callbacks: {
                                //     label: function(tooltipItem, data) {
                                //         return numeral(tooltipItem.value).format('0,0 $')
                                //     }
                                // }
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    });
                }
            });
        });
    });
</script>
@endpush