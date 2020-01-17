<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DiaDiem;
use App\Models\TinhThanh;
use App\Models\QuangCao;
use App\Models\Auth\User;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
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

        return view('backend.dashboard')
            ->with('baocaodata', $baocao)
            ->with('top5diadiems', $top5diadiems)
            ->with('quangcaos', $quangcaos)
            ->with('tongsoluotdanhgia', $tongsoluotdanhgia);
    }
}
