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
use App\Http\Controllers\Controller;
use App\Repositories\Backend\DiaDiemRepository;
use App\Models\Auth\User;

/**
 * Class DiaDiemController.
 */
class DiaDiemController extends Controller
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
        $users = User::all();
        //dd($users);
        return view('frontend.diadiem.index')
            ->with('users', $users);
    }

    public function show(ManageDiaDiemRequest $request, $_id)
    {
        $DiaDiem = DiaDiem::find($_id);
        $diem = 0;
        $sumDiem = 0;
        foreach($DiaDiem->danhgias()->get() as $key=>$value)
        {
            $sumDiem += empty($value->diem) ? 0 : $value->diem;
        }
        if($DiaDiem->danhgias()->count() <= 0)
        {
            $DiaDiem->diemtrungbinh = 0;
        }
        else
        {
            $DiaDiem->diemtrungbinh = $sumDiem / $DiaDiem->danhgias()->count();
        }
        return view('frontend.diadiem.show')
            ->with('diadiem', $DiaDiem);
    }

    public function goidanhgia(Request $request, $_id)
    {
        $DiaDiem = DiaDiem::find($_id);
        $inputs = $request->only(
            'diem',
            'noidung'
        );
        $inputs['email'] = auth()->user()->email;
        $inputs['first_name'] = auth()->user()->first_name;
        $inputs['last_name'] = auth()->user()->last_name;
        // dd($request, $_id, $inputs);

        $this->DiaDiemRepository->createDanhGia($DiaDiem, $inputs);
        return redirect()->route('frontend.diadiem.show', ['diadiem' => $_id])->withFlashSuccess('Đánh giá của bạn đã được lưu vào Hệ thống!');
    }
}
