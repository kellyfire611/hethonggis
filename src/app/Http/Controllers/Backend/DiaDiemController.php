<?php

namespace App\Http\Controllers\Backend;

use App\Models\DiaDiem;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\DiaDiemRepository;
use App\Http\Requests\Backend\DiaDiem\StoreDiaDiemRequest;
use App\Http\Requests\Backend\DiaDiem\ManageDiaDiemRequest;
use App\Http\Requests\Backend\DiaDiem\UpdateDiaDiemRequest;

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
     * @param ManageDiaDiemRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageDiaDiemRequest $request)
    {
        return view('backend.diaDiem.index')
            ->with('diadiems', $this->DiaDiemRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageDiaDiemRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageDiaDiemRequest $request)
    {
        $diachis = [];
        $tinhthanh = TinhThanh::all();
        foreach($tinhthanh as $keyTT => $valueTT)
        {
            foreach($valueTT->quanhuyens as $keyQH => $valueQH)
            {
                foreach($valueQH->xaphuongs as $keyXP => $valueXP)
                {
                    $diachis[] = [
                        'tinhthanh' => $valueTT->tentinhthanh,
                        'quanhuyen' => $valueQH->tenquanhuyen,
                        'xaphuong' => $valueXP->tenxaphuong,
                        'all' => "$valueTT->tentinhthanh - $valueQH->tenquanhuyen - $valueXP->tenxaphuong"
                    ];
                }
            }
        }
        //dd($diachis[0]['all']);

        return view('backend.diaDiem.create')
            ->with('diachis', $diachis);
    }

    /**
     * @param StoreDiaDiemRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreDiaDiemRequest $request)
    {
        // dd($request);
        $inputs = $request->only(
            'tendiadiem',
            'motangan',
            'gioithieu',
            'tukhoa',
            'dienthoai',
            'email',
            'giomocua',
            'giodongcua',
            'GPS'
        );
        $inputs['trangthai'] = $request->has('trangthai') ? '1' : '0';

        $strTinhThanh = $request->input('slTinhThanh');
        $arrTinhThanh = explode("-", $strTinhThanh);
        $inputs['diachi'] = new DiaChi([
            'tendiachi' => $request->input('tendiachi'),
            'tinhthanh' => isset($arrTinhThanh[0]) ? trim($arrTinhThanh[0]) : '',
            'quanhuyen' => isset($arrTinhThanh[1]) ? trim($arrTinhThanh[1]) : '',
            'xaphuong' => isset($arrTinhThanh[2]) ? trim($arrTinhThanh[2]) : '',
        ]);

        // $inputs['diachi'] = new DiaChi([
        //     'tendiachi' => $request->input('tendiachi'),
        //     'tinhthanh' => $request->input('tinhthanh'),
        //     'quanhuyen' => $request->input('quanhuyen'),
        //     'xaphuong' => $request->input('xaphuong'),
        // ]);

        $anhdaidien_file;
        if($request->hasFile('anhdaidien_file'))
        {
            $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
            $file     = $request->anhdaidien_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['anhdaidien'] = $filePath;
            
            // dd($file->getPathName());
            $temp = file_get_contents($file->getPathName());
            $blob = base64_encode($temp);
            $inputs['anhdaidien_blob'] = $blob;
            // dd($file, $blob);
        }
        else
        {
            $inputs['anhdaidien'] = null;
            $inputs['anhdaidien_blob'] = null;
        }

        // Dịch vụ
        $dichvus = [];
        foreach($request->input('dichvu_tendichvu') as $key => $value) {
            $dv = new DichVu([
                'tendichvu' => $request->input('dichvu_tendichvu')[$key], 
                'motangan' => $request->input('dichvu_motangan')[$key], 
                'gioithieu' => $request->input('dichvu_gioithieu')[$key], 
                'gia' => $request->input('dichvu_gia')[$key],
            ]);

            $dichvu_anhdaidien_file;
            if($request->hasFile('dichvu_anhdaidien_file') && isset($request->dichvu_anhdaidien_file[$key])) {
                $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
                $file     = $request->dichvu_anhdaidien_file[$key];
                $fileName = rand(1, 999) . $file->getClientOriginalName();
                $filePath = $upload_dir  . $fileName;

                $file->storeAs('public/' . $upload_dir, $fileName);
                $dv->anhdaidien = $filePath;
            }
            else
            {
                //$dv->anhdaidien
            }
            $dichvus[] = $dv;
        }
        $inputs['dichvus'] = $dichvus;

        $this->DiaDiemRepository->create($inputs);

        return redirect()->route('admin.diadiem.index')->withFlashSuccess('Thêm mới Địa điểm thành công');
    }

    /**
     * @param ManageDiaDiemRequest $request
     * @param DiaDiem              $DiaDiem
     *
     * @return mixed
     */
    public function show(ManageDiaDiemRequest $request, $_id)
    {
        $DiaDiem = DiaDiem::find($_id);

        $path = $DiaDiem->anhdaidien;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = $DiaDiem->anhdaidien_blob;
        if(empty($data))
        {
            $base64 = asset('storage/'.$path);
        }
        else
        {
            $base64 = 'data:image/' . $type . ';base64,' . $data;
        }

        return view('backend.diadiem.show')
            ->with('diadiem', $DiaDiem)
            ->with('anhdaidien_base64', $base64);
    }

    /**
     * @param ManageDiaDiemRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param DiaDiem                 $DiaDiem
     *
     * @return mixed
     */
    public function edit(ManageDiaDiemRequest $request, $_id)
    {
        $DiaDiem = DiaDiem::find($_id);
        $diachis = [];
        $tinhthanh = TinhThanh::all();
        foreach($tinhthanh as $keyTT => $valueTT)
        {
            foreach($valueTT->quanhuyens as $keyQH => $valueQH)
            {
                foreach($valueQH->xaphuongs as $keyXP => $valueXP)
                {
                    $diachis[] = [
                        'tinhthanh' => $valueTT->tentinhthanh,
                        'quanhuyen' => $valueQH->tenquanhuyen,
                        'xaphuong' => $valueXP->tenxaphuong,
                        'all' => "$valueTT->tentinhthanh - $valueQH->tenquanhuyen - $valueXP->tenxaphuong"
                    ];
                }
            }
        }
        $DiaDiem->diachiedit = $DiaDiem->diachi->tinhthanh.' - '.$DiaDiem->diachi->quanhuyen.' - '.$DiaDiem->diachi->xaphuong;
        $diachis[] = [
            'tinhthanh' => $DiaDiem->diachi->tinhthanh,
            'quanhuyen' => $DiaDiem->diachi->quanhuyen,
            'xaphuong' => $DiaDiem->diachi->xaphuong,
            'all' => $DiaDiem->diachi->tinhthanh.' - '.$DiaDiem->diachi->quanhuyen.' - '.$DiaDiem->diachi->xaphuong
        ];
        // dd($DiaDiem);
        return view('backend.diadiem.edit')
            ->with('diadiem', $DiaDiem)
            ->with('diachis', $diachis);
    }

    /**
     * @param UpdateDiaDiemRequest $request
     * @param DiaDiem              $DiaDiem
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateDiaDiemRequest $request, $_id)
    {
        // dd($request);
        // Địa điểm
        $DiaDiem = DiaDiem::find($_id);
        $inputs = $request->only(
            'tendiadiem',
            'motangan',
            'gioithieu',
            'tukhoa',
            'dienthoai',
            'email',
            'giomocua',
            'giodongcua',
            'GPS'
        );
        $inputs['trangthai'] = $request->has('trangthai') ? '1' : '0';

        $strTinhThanh = $request->input('slTinhThanh');
        $arrTinhThanh = explode("-", $strTinhThanh);
        $inputs['diachi'] = new DiaChi([
            'tendiachi' => $request->input('tendiachi'),
            'tinhthanh' => isset($arrTinhThanh[0]) ? trim($arrTinhThanh[0]) : '',
            'quanhuyen' => isset($arrTinhThanh[1]) ? trim($arrTinhThanh[1]) : '',
            'xaphuong' => isset($arrTinhThanh[2]) ? trim($arrTinhThanh[2]) : '',
        ]);

        // $inputs['diachi'] = new DiaChi([
        //     'tendiachi' => $request->input('tendiachi'),
        //     'tinhthanh' => $request->input('tinhthanh'),
        //     'quanhuyen' => $request->input('quanhuyen'),
        //     'xaphuong' => $request->input('xaphuong'),
        // ]);
        
        $anhdaidien_file;
        if($request->hasFile('anhdaidien_file'))
        {
            $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
            $file     = $request->anhdaidien_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['anhdaidien'] = $filePath;

            $temp = file_get_contents($file->getPathName());
            $blob = base64_encode($temp);
            $inputs['anhdaidien_blob'] = $blob;
        }
        else
        {
            $inputs['anhdaidien'] = $DiaDiem->anhdaidien;
        }
        
        // Dịch vụ
        $dichvus = [];
        foreach($request->input('dichvu_tendichvu') as $key => $value) {
            $dv = new DichVu([
                'tendichvu' => $request->input('dichvu_tendichvu')[$key], 
                'motangan' => $request->input('dichvu_motangan')[$key], 
                'gioithieu' => $request->input('dichvu_gioithieu')[$key], 
                'gia' => $request->input('dichvu_gia')[$key],
            ]);

            $dichvu_anhdaidien_file;
            if($request->hasFile('dichvu_anhdaidien_file') && isset($request->dichvu_anhdaidien_file[$key])) {
                $upload_dir = 'uploads/img/' . date("Y") . '/' . date("m") . "/";
                $file     = $request->dichvu_anhdaidien_file[$key];
                $fileName = rand(1, 999) . $file->getClientOriginalName();
                $filePath = $upload_dir  . $fileName;

                $file->storeAs('public/' . $upload_dir, $fileName);
                $dv->anhdaidien = $filePath;
            }
            else
            {
                $dv->anhdaidien = $request->dichvu_anhdaidien_old_file[$key];
            }
            $dichvus[] = $dv;
        }
        $inputs['dichvus'] = $dichvus;

        //dd($request, $inputs);
        // Save
        $DiaDiemUpdated = $this->DiaDiemRepository->update($DiaDiem, $inputs);
        if($DiaDiemUpdated)
        {
            // Xóa hình cũ để tránh rác
            //Storage::delete('public/uploads/img/' . $sp->sp_hinh);
        }

        return redirect()->route('admin.diadiem.index')->withFlashSuccess('Cập nhật Địa điểm thành công!');
    }

    /**
     * @param ManageDiaDiemRequest $request
     * @param DiaDiem              $DiaDiem
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageDiaDiemRequest $request, $_id)
    {
        $this->DiaDiemRepository->deleteById($_id);

        return redirect()->route('admin.diadiem.index')->withFlashSuccess('Xóa địa điểm thành công');
    }
}
