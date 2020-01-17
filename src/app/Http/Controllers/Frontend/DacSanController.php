<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\DacSan\ManageDacSanRequest;
use App\Models\DacSan;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\DacSanRepository;
use App\Models\Auth\User;

/**
 * Class DacSanController.
 */
class DacSanController extends Controller
{
    /**
     * @var DacSanRepository
     */
    protected $DacSanRepository;

    /**
     * DacSanController constructor.
     *
     * @param DacSanRepository $DacSanRepository
     */
    public function __construct(DacSanRepository $DacSanRepository)
    {
        $this->DacSanRepository = $DacSanRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        //dd($users);
        return view('frontend.dacsan.index')
            ->with('users', $users);
    }

    public function show(ManageDacSanRequest $request, $_id)
    {
        $DacSan = DacSan::find($_id);
        $diem = 0;
        $sumDiem = 0;
        foreach($DacSan->danhgias()->get() as $key=>$value)
        {
            $sumDiem += empty($value->diem) ? 0 : $value->diem;
        }
        if($DacSan->danhgias()->count() <= 0)
        {
            $DacSan->diemtrungbinh = 0;
        }
        else
        {
            $DacSan->diemtrungbinh = $sumDiem / $DacSan->danhgias()->count();
        }
        return view('frontend.dacsan.show')
            ->with('dacsan', $DacSan);
    }

    public function goidanhgia(Request $request, $_id)
    {
        $DacSan = DacSan::find($_id);
        $inputs = $request->only(
            'diem',
            'noidung'
        );
        $inputs['email'] = auth()->user()->email;
        $inputs['first_name'] = auth()->user()->first_name;
        $inputs['last_name'] = auth()->user()->last_name;
        // dd($request, $_id, $inputs);

        $this->DacSanRepository->createDanhGia($DacSan, $inputs);
        return redirect()->route('frontend.dacsan.show', ['dacsan' => $_id])->withFlashSuccess('Đánh giá của bạn đã được lưu vào Hệ thống!');
    }
}
