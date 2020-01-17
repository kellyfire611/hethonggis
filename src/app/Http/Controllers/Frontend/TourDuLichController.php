<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\TourDuLich\ManageTourDuLichRequest;
use App\Models\TourDuLich;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\TourDuLichRepository;
use App\Models\Auth\User;

/**
 * Class TourDuLichController.
 */
class TourDuLichController extends Controller
{
    /**
     * @var TourDuLichRepository
     */
    protected $TourDuLichRepository;

    /**
     * TourDuLichController constructor.
     *
     * @param TourDuLichRepository $TourDuLichRepository
     */
    public function __construct(TourDuLichRepository $TourDuLichRepository)
    {
        $this->TourDuLichRepository = $TourDuLichRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        //dd($users);
        return view('frontend.tourdulich.index')
            ->with('users', $users);
    }

    public function show(ManageTourDuLichRequest $request, $_id)
    {
        $TourDuLich = TourDuLich::find($_id);
        $diem = 0;
        $sumDiem = 0;
        foreach($TourDuLich->danhgias()->get() as $key=>$value)
        {
            $sumDiem += empty($value->diem) ? 0 : $value->diem;
        }
        if($TourDuLich->danhgias()->count() <= 0)
        {
            $TourDuLich->diemtrungbinh = 0;
        }
        else
        {
            $TourDuLich->diemtrungbinh = $sumDiem / $TourDuLich->danhgias()->count();
        }
        
        return view('frontend.tourdulich.show')
            ->with('tourdulich', $TourDuLich);
    }

    public function goidanhgia(Request $request, $_id)
    {
        $TourDuLich = TourDuLich::find($_id);
        $inputs = $request->only(
            'diem',
            'noidung'
        );
        $inputs['email'] = auth()->user()->email;
        $inputs['first_name'] = auth()->user()->first_name;
        $inputs['last_name'] = auth()->user()->last_name;
        // dd($request, $_id, $inputs);

        $this->TourDuLichRepository->createDanhGia($TourDuLich, $inputs);
        return redirect()->route('frontend.tourdulich.show', ['tourdulich' => $_id])->withFlashSuccess('Đánh giá của bạn đã được lưu vào Hệ thống!');
    }
}
