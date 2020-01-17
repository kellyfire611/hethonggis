<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DiaDiem;
use App\Models\TinhThanh;
use App\Models\QuangCao;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use DB;

/**
 * Class BaoCaoController.
 */
class BaoCaoController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $baocao= [];
        $diadiems = DiaDiem::all();
        $baocao['diadiem_count'] = $diadiems->count();

        $baocao['dichvu_count'] = 0;
        foreach($diadiems as $key=>$value)
        {
            $baocao['dichvu_count'] += $value->dichvus->count();
        }

        $users = User::all();
        $baocao['user_count'] = $users->count();

        $tinhthanhs = TinhThanh::all();
        $baocao['tinhthanh_count'] = $tinhthanhs->count();

        $tongsoluotdanhgia = 0;
        foreach($diadiems as $diadiem)
        {
            $diem = 0;
            $sumDiem = 0;
            foreach($diadiem->danhgias()->get() as $key=>$value)
            {
                $sumDiem += empty($value->diem) ? 0 : $value->diem;
            }
            if($diadiem->danhgias()->count() <= 0)
            {
                $diadiem->diemtrungbinh = 0;
            }
            else
            {
                $diadiem->diemtrungbinh = $sumDiem / $diadiem->danhgias()->count();
            }
            $tongsoluotdanhgia += $diadiem->danhgias()->count();
        }
        
        $quangcaos = QuangCao::all();

        $top5diadiems = $diadiems->sortByDesc('diemtrungbinh')->take(5);

        return view('backend.baocao.soluongdiemthamquan')
            ->with('baocaodata', $baocao)
            ->with('top5diadiems', $top5diadiems)
            ->with('quangcaos', $quangcaos)
            ->with('tongsoluotdanhgia', $tongsoluotdanhgia)
            ->with('tinhthanhs', $tinhthanhs)
            ;
    }

    /**
     * Action AJAX get data cho báo cáo Số lượng điểm tham quan
     */
    public function soluongdiemthamquanData(Request $request)
    {
        $parameter = [
            'idTinhThanh' => $request->idTinhThanh,
        ];
        // 2019-07-21    50,000,000
        // 2019-07-20    40,000,000
        $sql = '
            SELECT tt.ID_1, tt.NAME_1 AS TenTinhThanh, COUNT(*) AS SoLuong
            FROM diemthamquan dtq
            JOIN quanhuyen_attributes qh ON dtq.id_quanhuyen = qh.ID_2
            JOIN tinh_attributes tt ON qh.ID_1 = tt.ID_1
        ';
        if($parameter['idTinhThanh'] > 0) {
            $sql .= ' WHERE tt.ID_1 = :idTinhThanh';
        }
        $sql .= ' GROUP BY tt.ID_1, tt.NAME_1;';

        $data = DB::select($sql, $parameter);

        $lstIdTinhThanhs = collect($data)->map(function ($event, $key) {
            return $event->ID_1;
        })->all();
        // dd($collectData);

        // Get các tọa độ điểm POLYGON tỉnh thành
        $resultDataMap = [];
        foreach($lstIdTinhThanhs as $idTinhThanh) {
            $parameterMap = [
                'idTinhThanh' => $idTinhThanh,
            ];
            $sqlCoordinates = '
                SELECT y, x FROM tinh_nodes WHERE shapeid = :idTinhThanh;
            ';
            $dataCoordinates = collect(DB::select($sqlCoordinates, $parameterMap));
            $coordinates = $dataCoordinates->map(function ($event, $key) {
                return [ $event->y, $event->x ];
            })->values();

            $resultDataMap[] = $coordinates;
        }

        // JSON
        return response()->json(array(
            'code' => 200, 
            'data' => $data,
            'map' => $resultDataMap
        ));
    }
}
