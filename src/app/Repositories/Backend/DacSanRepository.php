<?php

namespace App\Repositories\Backend;

use App\Models\DacSan;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\DanhGia;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\DacSanAccountActive;
use App\Notifications\Frontend\Auth\DacSanNeedsConfirmation;

/**
 * Class DacSanRepository.
 */
class DacSanRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return DacSan::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function search(array $data)
    {
        if(empty($data['keyword']))
        {
            return $this->model->all();
        }

        $keyword = $data['keyword'];
        if($data['type_search'] == 'tendacsan')
        {
            $result = $this->model->where('tendacsan', 'LIKE', "%$keyword%")->get();
        }
        // else if($data['type_search'] == 'tentinhthanh')
        // {
        //     $result = $this->model
        //         ->where('diachi.tinhthanh', 'LIKE', "%$keyword%")
        //         ->orWhere('diachi.quanhuyen', 'LIKE', "%$keyword%")
        //         ->orWhere('diachi.xaphuong', 'LIKE', "%$keyword%")
        //         ->get();
        // }
        // else if($data['type_search'] == 'giatien')
        // {
        //     $result = $this->model
        //         ->whereBetween('dichvus.gia', [0, (float)$keyword])
        //         ->get();
        // }
        
        // dd($result);
        return $result;
    }

    /**
     * @param array $data
     *
     * @return DacSan
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : DacSan
    {
        // dd($data);
        $DacSan = parent::create([
            'tendacsan' => $data['tendacsan'],
            'giatour_nguoilon' => $data['giatour_nguoilon'],
            'giatour_treem' => $data['giatour_treem'],
            'diemkhoihanh_ten' => $data['diemkhoihanh_ten'],
            'diemkhoihanh_id_quanhuyen' => $data['diemkhoihanh_id_quanhuyen'],
            'diemkhoihanh_toado' => $data['diemkhoihanh_toado'],
            'diemden_ten' => $data['diemden_ten'],
            'diemden_id_quanhuyen' => $data['diemden_id_quanhuyen'],
            'diemden_toado' => $data['diemden_toado'],
            'songaytour' => $data['songaytour'],
            'hinhanh' => $data['hinhanh'],
        ]);
        
        // $DacSan->diachi()->save($data['diachi']);

        // foreach($data['dichvus'] as $key=>$value)
        // {
        //     $DacSan->dichvus()->save($value);
        // }

        if ($DacSan) {
            return $DacSan;
        }

        throw new GeneralException(__('exceptions.backend.access.DacSans.create_error'));
    }

    /**
     * @param DacSan  $DacSan
     * @param array $data
     *
     * @return DacSan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(DacSan $DacSan, array $data) : DacSan
    {   
        if ($DacSan->update([
            'tendacsan' => $data['tendacsan'],
            'giatour_nguoilon' => $data['giatour_nguoilon'],
            'giatour_treem' => $data['giatour_treem'],
            'diemkhoihanh_ten' => $data['diemkhoihanh_ten'],
            'diemkhoihanh_id_quanhuyen' => $data['diemkhoihanh_id_quanhuyen'],
            'diemkhoihanh_toado' => $data['diemkhoihanh_toado'],
            'diemden_ten' => $data['diemden_ten'],
            'diemden_id_quanhuyen' => $data['diemden_id_quanhuyen'],
            'diemden_toado' => $data['diemden_toado'],
            'songaytour' => $data['songaytour'],
            'hinhanh' => $data['hinhanh'],
        ])) {
            
            // $DacSan->diachi()->save($data['diachi']);
            
            // foreach($DacSan->dichvus as $key=>$value)
            // {
            //     $DacSan->dichvus()->destroy($value);
            // }

            // foreach($data['dichvus'] as $key=>$value)
            // {
            //     $DacSan->dichvus()->save($value);
            // }
            
            return $DacSan;
        }

        throw new GeneralException(__('exceptions.backend.access.DacSans.update_error'));
    }

    /**
     * @param DacSan  $DacSan
     * @param array $data
     *
     * @return DacSan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function createDanhGia(DacSan $DacSan, array $data) : DacSan
    {   
        $DacSan->danhgias()->save(new DanhGia([
            'email' => $data['email'], 
            'first_name' => $data['first_name'], 
            'last_name' => $data['last_name'], 
            'noidung' => $data['noidung'], 
            'diem' => $data['diem'], 
            'trangthai' => 0 //chưa duyệt
        ]));
        return $DacSan;

        throw new GeneralException(__('exceptions.backend.access.DacSans.update_error'));
    }

    /**
     * @param DacSan $DacSan
     *
     * @return DacSan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(DacSan $DacSan) : DacSan
    {
        if (is_null($DacSan->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.DacSans.delete_first'));
        }

        // Delete associated relationships
        $DacSan->passwordHistories()->delete();
        $DacSan->providers()->delete();
        $DacSan->sessions()->delete();

        if ($DacSan->forceDelete()) {
            return $DacSan;
        }

        throw new GeneralException(__('exceptions.backend.access.DacSans.delete_error'));
    }

    /**
     * @param DacSan $DacSan
     *
     * @return DacSan
     * @throws GeneralException
     */
    public function restore(DacSan $DacSan) : DacSan
    {
        if (is_null($DacSan->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.DacSans.cant_restore'));
        }

        if ($DacSan->restore()) {
            return $DacSan;
        }

        throw new GeneralException(__('exceptions.backend.access.DacSans.restore_error'));
    }
}
