<?php

namespace App\Http\Controllers\Backend;

use App\Models\TourDuLich;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\TourDuLichRepository;
use App\Http\Requests\Backend\TourDuLich\StoreTourDuLichRequest;
use App\Http\Requests\Backend\TourDuLich\ManageTourDuLichRequest;
use App\Http\Requests\Backend\TourDuLich\UpdateTourDuLichRequest;

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
     * @param ManageTourDuLichRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageTourDuLichRequest $request)
    {
        return view('backend.tourdulich.index')
            ->with('tourdulichs', $this->TourDuLichRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageTourDuLichRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageTourDuLichRequest $request)
    {
        $diachis = [];
        // $tinhthanh = TinhThanh::all();
        $quanhuyens = QuanHuyen::all();
        // foreach($tinhthanh as $keyTT => $valueTT)
        // {
        //     foreach($valueTT->quanhuyens as $keyQH => $valueQH)
        //     {
        //         foreach($valueQH->xaphuongs as $keyXP => $valueXP)
        //         {
        //             $diachis[] = [
        //                 'tinhthanh' => $valueTT->tentinhthanh,
        //                 'quanhuyen' => $valueQH->tenquanhuyen,
        //                 'xaphuong' => $valueXP->tenxaphuong,
        //                 'all' => "$valueTT->tentinhthanh - $valueQH->tenquanhuyen - $valueXP->tenxaphuong"
        //             ];
        //         }
        //     }
        // }
        //dd($diachis[0]['all']);

        return view('backend.tourdulich.create')
            ->with('quanhuyens', $quanhuyens);
    }

    /**
     * @param StoreTourDuLichRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreTourDuLichRequest $request)
    {
        // dd($request);
        $inputs = $request->only(
            'matourdulich',
            'tentourdulich',
            'giatour_nguoilon',
            'giatour_treem',
            'diemkhoihanh_ten',
            'diemkhoihanh_id_quanhuyen',
            'diemkhoihanh_toado_string',
            'diemden_ten',
            'diemden_id_quanhuyen',
            'diemden_toado_string',
            'songaytour'
        );

        // $anhdaidien_file;
        if($request->hasFile('hinhanh_file'))
        {
            // $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
            $upload_dir = '';
            $file     = $request->hinhanh_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['hinhanh'] = $filePath;
            
            // dd($file->getPathName());
            // $temp = file_get_contents($file->getPathName());
            // $blob = base64_encode($temp);
            // $inputs['anhdaidien_blob'] = $blob;
            // dd($file, $blob);
        }
        else
        {
            $inputs['hinhanh'] = null;
            // $inputs['anhdaidien_blob'] = null;
        }

        // Dịch vụ
        // $dichvus = [];
        // foreach($request->input('dichvu_tendichvu') as $key => $value) {
        //     $dv = new DichVu([
        //         'tendichvu' => $request->input('dichvu_tendichvu')[$key], 
        //         'motangan' => $request->input('dichvu_motangan')[$key], 
        //         'gioithieu' => $request->input('dichvu_gioithieu')[$key], 
        //         'gia' => $request->input('dichvu_gia')[$key],
        //     ]);

        //     $dichvu_anhdaidien_file;
        //     if($request->hasFile('dichvu_anhdaidien_file') && isset($request->dichvu_anhdaidien_file[$key])) {
        //         $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
        //         $file     = $request->dichvu_anhdaidien_file[$key];
        //         $fileName = rand(1, 999) . $file->getClientOriginalName();
        //         $filePath = $upload_dir  . $fileName;

        //         $file->storeAs('public/' . $upload_dir, $fileName);
        //         $dv->anhdaidien = $filePath;
        //     }
        //     else
        //     {
        //         //$dv->anhdaidien
        //     }
        //     $dichvus[] = $dv;
        // }
        // $inputs['dichvus'] = $dichvus;

        $this->TourDuLichRepository->create($inputs);

        return redirect()->route('admin.tourdulich.index')->withFlashSuccess('Thêm mới Tour du lịch thành công');
    }

    /**
     * @param ManageTourDuLichRequest $request
     * @param TourDuLich              $TourDuLich
     *
     * @return mixed
     */
    public function show(ManageTourDuLichRequest $request, $_id)
    {
        $TourDuLich = TourDuLich::find($_id);

        $path = $TourDuLich->anhdaidien;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = $TourDuLich->anhdaidien_blob;
        if(empty($data))
        {
            $base64 = asset('storage/'.$path);
        }
        else
        {
            $base64 = 'data:image/' . $type . ';base64,' . $data;
        }

        return view('backend.tourdulich.show')
            ->with('tourdulich', $TourDuLich)
            ->with('anhdaidien_base64', $base64);
    }

    /**
     * @param ManageTourDuLichRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param TourDuLich                 $TourDuLich
     *
     * @return mixed
     */
    public function edit(ManageTourDuLichRequest $request, $_id)
    {
        $TourDuLich = TourDuLich::find($_id);
        $quanhuyens = QuanHuyen::all();
        // $diachis = [];
        // $tinhthanh = TinhThanh::all();
        // foreach($tinhthanh as $keyTT => $valueTT)
        // {
        //     foreach($valueTT->quanhuyens as $keyQH => $valueQH)
        //     {
        //         foreach($valueQH->xaphuongs as $keyXP => $valueXP)
        //         {
        //             $diachis[] = [
        //                 'tinhthanh' => $valueTT->tentinhthanh,
        //                 'quanhuyen' => $valueQH->tenquanhuyen,
        //                 'xaphuong' => $valueXP->tenxaphuong,
        //                 'all' => "$valueTT->tentinhthanh - $valueQH->tenquanhuyen - $valueXP->tenxaphuong"
        //             ];
        //         }
        //     }
        // }
        // $TourDuLich->diachiedit = $TourDuLich->diachi->tinhthanh.' - '.$TourDuLich->diachi->quanhuyen.' - '.$TourDuLich->diachi->xaphuong;
        // $diachis[] = [
        //     'tinhthanh' => $TourDuLich->diachi->tinhthanh,
        //     'quanhuyen' => $TourDuLich->diachi->quanhuyen,
        //     'xaphuong' => $TourDuLich->diachi->xaphuong,
        //     'all' => $TourDuLich->diachi->tinhthanh.' - '.$TourDuLich->diachi->quanhuyen.' - '.$TourDuLich->diachi->xaphuong
        // ];
        // dd($TourDuLich);
        return view('backend.tourdulich.edit')
            ->with('tourdulich', $TourDuLich)
            ->with('quanhuyens', $quanhuyens);
            // ->with('diachis', $diachis);
    }

    /**
     * @param UpdateTourDuLichRequest $request
     * @param TourDuLich              $TourDuLich
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateTourDuLichRequest $request, $_id)
    {
        // dd($request);
        // Tour du lịch
        $TourDuLich = TourDuLich::find($_id);
        $inputs = $request->only(
            'matourdulich',
            'tentourdulich',
            'giatour_nguoilon',
            'giatour_treem',
            'diemkhoihanh_ten',
            'diemkhoihanh_id_quanhuyen',
            'diemkhoihanh_toado_string',
            'diemden_ten',
            'diemden_id_quanhuyen',
            'diemden_toado_string',
            'songaytour'
        );

        

        // $strTinhThanh = $request->input('slTinhThanh');
        // $arrTinhThanh = explode("-", $strTinhThanh);
        // $inputs['diachi'] = new DiaChi([
        //     'tendiachi' => $request->input('tendiachi'),
        //     'tinhthanh' => isset($arrTinhThanh[0]) ? trim($arrTinhThanh[0]) : '',
        //     'quanhuyen' => isset($arrTinhThanh[1]) ? trim($arrTinhThanh[1]) : '',
        //     'xaphuong' => isset($arrTinhThanh[2]) ? trim($arrTinhThanh[2]) : '',
        // ]);

        // $inputs['diachi'] = new DiaChi([
        //     'tendiachi' => $request->input('tendiachi'),
        //     'tinhthanh' => $request->input('tinhthanh'),
        //     'quanhuyen' => $request->input('quanhuyen'),
        //     'xaphuong' => $request->input('xaphuong'),
        // ]);
        
        // $anhdaidien_file;
        if($request->hasFile('hinhanh_file'))
        {
            // $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
            $upload_dir = '';
            $file     = $request->hinhanh_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['hinhanh'] = $filePath;

            // $temp = file_get_contents($file->getPathName());
            // $blob = base64_encode($temp);
            // $inputs['anhdaidien_blob'] = $blob;
        }
        else
        {
            $inputs['hinhanh'] = $TourDuLich->hinhanh;
        }
        
        // Dịch vụ
        // $dichvus = [];
        // foreach($request->input('dichvu_tendichvu') as $key => $value) {
        //     $dv = new DichVu([
        //         'tendichvu' => $request->input('dichvu_tendichvu')[$key], 
        //         'motangan' => $request->input('dichvu_motangan')[$key], 
        //         'gioithieu' => $request->input('dichvu_gioithieu')[$key], 
        //         'gia' => $request->input('dichvu_gia')[$key],
        //     ]);

        //     $dichvu_anhdaidien_file;
        //     if($request->hasFile('dichvu_anhdaidien_file') && isset($request->dichvu_anhdaidien_file[$key])) {
        //         $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
        //         $file     = $request->dichvu_anhdaidien_file[$key];
        //         $fileName = rand(1, 999) . $file->getClientOriginalName();
        //         $filePath = $upload_dir  . $fileName;

        //         $file->storeAs('public/' . $upload_dir, $fileName);
        //         $dv->anhdaidien = $filePath;
        //     }
        //     else
        //     {
        //         $dv->anhdaidien = $request->dichvu_anhdaidien_old_file[$key];
        //     }
        //     $dichvus[] = $dv;
        // }
        // $inputs['dichvus'] = $dichvus;

        //dd($request, $inputs);
        // Save
        $TourDuLichUpdated = $this->TourDuLichRepository->update($TourDuLich, $inputs);
        if($TourDuLichUpdated)
        {
            // Xóa hình cũ để tránh rác
            //Storage::delete('public/uploads/img/' . $sp->sp_hinh);
        }

        return redirect()->route('admin.tourdulich.index')->withFlashSuccess('Cập nhật Tour du lịch thành công!');
    }

    /**
     * @param ManageTourDuLichRequest $request
     * @param TourDuLich              $TourDuLich
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageTourDuLichRequest $request, $_id)
    {
        $this->TourDuLichRepository->deleteById($_id);

        return redirect()->route('admin.tourdulich.index')->withFlashSuccess('Xóa địa điểm thành công');
    }
}
