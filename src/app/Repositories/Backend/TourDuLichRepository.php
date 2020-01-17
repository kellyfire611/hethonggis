<?php

namespace App\Repositories\Backend;

use App\Models\TourDuLich;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\DanhGia;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\TourDuLichAccountActive;
use App\Notifications\Frontend\Auth\TourDuLichNeedsConfirmation;

/**
 * Class TourDuLichRepository.
 */
class TourDuLichRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return TourDuLich::class;
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
        if($data['type_search'] == 'tentourdulich')
        {
            $result = $this->model->where('tentourdulich', 'LIKE', "%$keyword%")->get();
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
     * @return TourDuLich
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : TourDuLich
    {
        // dd($data);
        $TourDuLich = parent::create([
            'tentourdulich' => $data['tentourdulich'],
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
        
        // $TourDuLich->diachi()->save($data['diachi']);

        // foreach($data['dichvus'] as $key=>$value)
        // {
        //     $TourDuLich->dichvus()->save($value);
        // }

        if ($TourDuLich) {
            return $TourDuLich;
        }

        throw new GeneralException(__('exceptions.backend.access.TourDuLichs.create_error'));
    }

    /**
     * @param TourDuLich  $TourDuLich
     * @param array $data
     *
     * @return TourDuLich
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(TourDuLich $TourDuLich, array $data) : TourDuLich
    {   
        if ($TourDuLich->update([
            'tentourdulich' => $data['tentourdulich'],
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
            
            // $TourDuLich->diachi()->save($data['diachi']);
            
            // foreach($TourDuLich->dichvus as $key=>$value)
            // {
            //     $TourDuLich->dichvus()->destroy($value);
            // }

            // foreach($data['dichvus'] as $key=>$value)
            // {
            //     $TourDuLich->dichvus()->save($value);
            // }
            
            return $TourDuLich;
        }

        throw new GeneralException(__('exceptions.backend.access.TourDuLichs.update_error'));
    }

    /**
     * @param TourDuLich  $TourDuLich
     * @param array $data
     *
     * @return TourDuLich
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function createDanhGia(TourDuLich $TourDuLich, array $data) : TourDuLich
    {   
        $TourDuLich->danhgias()->save(new DanhGia([
            'email' => $data['email'], 
            'first_name' => $data['first_name'], 
            'last_name' => $data['last_name'], 
            'noidung' => $data['noidung'], 
            'diem' => $data['diem'], 
            'trangthai' => 0 //chưa duyệt
        ]));
        return $TourDuLich;

        throw new GeneralException(__('exceptions.backend.access.TourDuLichs.update_error'));
    }

    /**
     * @param TourDuLich $TourDuLich
     *
     * @return TourDuLich
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(TourDuLich $TourDuLich) : TourDuLich
    {
        if (is_null($TourDuLich->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.TourDuLichs.delete_first'));
        }

        // Delete associated relationships
        $TourDuLich->passwordHistories()->delete();
        $TourDuLich->providers()->delete();
        $TourDuLich->sessions()->delete();

        if ($TourDuLich->forceDelete()) {
            return $TourDuLich;
        }

        throw new GeneralException(__('exceptions.backend.access.TourDuLichs.delete_error'));
    }

    /**
     * @param TourDuLich $TourDuLich
     *
     * @return TourDuLich
     * @throws GeneralException
     */
    public function restore(TourDuLich $TourDuLich) : TourDuLich
    {
        if (is_null($TourDuLich->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.TourDuLichs.cant_restore'));
        }

        if ($TourDuLich->restore()) {
            return $TourDuLich;
        }

        throw new GeneralException(__('exceptions.backend.access.TourDuLichs.restore_error'));
    }
}
