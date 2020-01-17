@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@push('after-styles')
<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}" />
<style>
  #mapid {
        height: 500px;
    }
</style>
@endpush

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
                        <div id="preMap">
                        <div id="mapid"></div>
                        </div>
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
<script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
<script>
    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    }

    function poolColors(a) {
        var pool = [];
        for(i = 0; i < a; i++) {
            pool.push(dynamicColors());
        }
        return pool;
    }

    
    $(document).ready(function() {
        var objChart;
        var $chartOfobjChart = document.getElementById("chartOfobjChart").getContext("2d");
        var map;
        $("#btnLapBaoCao").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.baocao.soluongdiemthamquan.data') }}',
                type: "GET",
                data: {
                    idTinhThanh: $('#id_tinhThanh').val(),
                },
                success: function(response) {
                    // debugger;
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
                                borderColor: poolColors(myData.length),
                                backgroundColor: poolColors(myData.length),
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

                    // Vẽ bản đồ Leaflet
                    // initialize Leaflet
                    if (map != undefined) { 
                        map.remove(); 
                        $("#mapid").html("");
                        $("#preMap").empty();
                        $( "<div id=\"mapid\" style=\"height: 500px;\"></div>" ).appendTo("#preMap");
                    }
                    
                    map = L.map('mapid').setView([14.6001567840577, 108.397979736328], 13);
                    
                    


                    // Setting custom icon
                    var LeafIcon = L.Icon.extend({
                        options: {
                            shadowUrl: '{{ asset('vendor/leaflet/images/leaf-shadow.png') }}',
                            iconSize:     [38, 95], // size of the icon
                            shadowSize:   [50, 64], // size of the shadow
                            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                            shadowAnchor: [4, 62],  // the same for the shadow
                            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                        }
                    });
                    var greenIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-green.png') }}'}),
                        redIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-red.png') }}'}),
                        orangeIcon = new LeafIcon({iconUrl: '{{ asset('vendor/leaflet/images/leaf-orange.png') }}'});

                    // add the OpenStreetMap tiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                    }).addTo(map);

                    // show the scale bar on the lower left corner
                    L.control.scale().addTo(map);

                    // Add tô màu vùng địa chính
                    // Cứ mỗi vùng kiếm được là 1 màu

                    //var coords = [[53.02068,-1.177565],[53.02068,-1.177529],[53.01392,-1.184813],[52.9996,-1.179552],[52.98669,-1.18368],[52.97328,-1.174253],[52.96742,-1.190667],[52.95318,-1.191675],[52.94076,-1.182942],[52.92892,-1.168955],[52.91526,-1.160708],[52.90665,-1.141897],[52.90181,-1.120173],[52.89815,-1.097902],[52.88871,-1.079905],[52.88071,-1.059252],[52.86815,-1.046174],[52.85532,-1.034603],[52.84477,-1.018005],[52.83515,-0.9996923],[52.82819,-0.9809427],[52.82284,-0.9621247],[52.81105,-0.9472224],[52.8036,-0.927404],[52.79135,-0.9146115],[52.78048,-0.8994353],[52.76687,-0.8894613],[52.76664,-0.8708082],[52.76659,-0.8708736],[52.76835,-0.891149],[52.78214,-0.901139],[52.79285,-0.9176971],[52.80486,-0.9299843],[52.81324,-0.9498426],[52.82246,-0.9662115],[52.82805,-0.9852306],[52.83673,-1.002167],[52.84597,-1.020533],[52.85667,-1.036038],[52.86976,-1.047891],[52.88192,-1.062801],[52.89071,-1.082117],[52.89929,-1.101],[52.90192,-1.123934],[52.90753,-1.145736],[52.91771,-1.161882],[52.93171,-1.170847],[52.94221,-1.187391],[52.9559,-1.191321],[52.97015,-1.188462],[52.98193,-1.173294],[52.98943,-1.164274],[52.99965,-1.179563],[53.01413,-1.184821],[53.02061,-1.177719],[53.02074,-1.177584]];
                    //var a = response.data.map;
                    // debugger;

                    $(response.map).each(function() {
                        // debugger;
                        var polygon = L.polygon(this, {fillColor: dynamicColors()}).addTo(map);
                    });
                }
            });
        });
    });
</script>
@endpush