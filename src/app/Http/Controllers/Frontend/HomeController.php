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
use App\Models\TourDuLich;
use App\Repositories\Backend\DiaDiemRepository;
use App\Repositories\Backend\TourDuLichRepository;
use App\Repositories\Backend\DacSanRepository;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @var DiaDiemRepository
     */
    protected $DiaDiemRepository;
    protected $TourDuLichRepository;
    protected $DacSanRepository;

    /**
     * DiaDiemController constructor.
     *
     * @param DiaDiemRepository $DiaDiemRepository
     */
    public function __construct(DiaDiemRepository $DiaDiemRepository, TourDuLichRepository $TourDuLichRepository, DacSanRepository $DacSanRepository)
    {
        $this->TourDuLichRepository = $TourDuLichRepository;
        $this->DiaDiemRepository = $DiaDiemRepository;
        $this->DacSanRepository = $DacSanRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get Tour du lịch
        $tourdulichs = TourDuLich::take(12)->get();

        $diadiems = DiaDiem::take(12)->get();

        foreach ($diadiems as $diadiem) {
            $diem = 0;
            $sumDiem = 0;
            foreach ($diadiem->danhgias()->get() as $key => $value) {
                $sumDiem += empty($value->diem) ? 0 : $value->diem;
            }
            if ($diadiem->danhgias()->count() <= 0) {
                $diadiem->diemtrungbinh = 0;
            } else {
                $diadiem->diemtrungbinh = $sumDiem / $diadiem->danhgias()->count();
            }
        }
        $topmonans = DiaDiem::all();
        foreach ($topmonans as $diadiem) {
            $diem = 0;
            $sumDiem = 0;
            foreach ($diadiem->danhgias()->get() as $key => $value) {
                $sumDiem += empty($value->diem) ? 0 : $value->diem;
            }
            if ($diadiem->danhgias()->count() <= 0) {
                $diadiem->diemtrungbinh = 0;
            } else {
                $diadiem->diemtrungbinh = $sumDiem / $diadiem->danhgias()->count();
            }
        }
        $quangcaos = QuangCao::all();

        $diadiems = $diadiems->sortByDesc('diemtrungbinh');
        return view('frontend.index')
            ->with('tourdulichs', $tourdulichs)
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

        if ($inputs['type_search'] == 'tentourdulich') {

            $inputs['keyword'] = trim($inputs['keyword']);
            $tourdulichs = $this->TourDuLichRepository->search($inputs);
            return view('frontend.searchTourDuLich')
                ->with('tourdulichs', $tourdulichs)
                ->with('inputs', $inputs);
        } else if ($inputs['type_search'] == 'tendiadiem') {

            $inputs['keyword'] = trim($inputs['keyword']);
            $diadiems = $this->DiaDiemRepository->search($inputs);
            return view('frontend.searchDiaDiem')
                ->with('diadiems', $diadiems)
                ->with('inputs', $inputs);
        } else if ($inputs['type_search'] == 'tendacsan') {

            $inputs['keyword'] = trim($inputs['keyword']);
            $dacsans = $this->DacSanRepository->search($inputs);
            return view('frontend.searchDacSan')
                ->with('dacsans', $dacsans)
                ->with('inputs', $inputs);
        }
    }
}
