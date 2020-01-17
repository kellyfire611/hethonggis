<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\DiaDiem\ManageDiaDiemRequest;
use App\Models\DiaDiem;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use App\Models\QuangCao;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\DiaDiemRepository;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @var DiaDiemRepository
     */
    protected $DiaDiemRepository;

    /**
     * DiaDiemController constructor.
     *
     * @param DiaDiemRepository $DiaDiemRepository
     */
    public function __construct(DiaDiemRepository $DiaDiemRepository)
    {
        $this->DiaDiemRepository = $DiaDiemRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $diadiems = DiaDiem::take(12)->get();

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
        }
        $topmonans = DiaDiem::all();
        foreach($topmonans as $diadiem)
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
        }
        $quangcaos = QuangCao::all();

        $diadiems = $diadiems->sortByDesc('diemtrungbinh');
        return view('frontend.index')
            ->with('diadiems', $diadiems)
            ->with('topmonans', $topmonans)
            ->with('quangcaos', $quangcaos);
    }

    public function search(Request $request)
    {
        $inputs = $request->only(
            'type_search',
            'keyword'
        );

        $inputs['keyword'] = trim($inputs['keyword']);
        $diadiems = $this->DiaDiemRepository->search($inputs);
        return view('frontend.search')
            ->with('diadiems', $diadiems)
            ->with('inputs', $inputs);
    }
}
