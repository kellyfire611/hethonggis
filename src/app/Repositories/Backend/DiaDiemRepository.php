<?php

namespace App\Repositories\Backend;

use App\Models\DiaDiem;
use App\Models\DichVu;
use App\Models\DiaChi;
use App\Models\DanhGia;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\DiaDiemAccountActive;
use App\Notifications\Frontend\Auth\DiaDiemNeedsConfirmation;

/**
 * Class DiaDiemRepository.
 */
class DiaDiemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return DiaDiem::class;
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
        if($data['type_search'] == 'tendiadiem')
        {
            $result = $this->model->where('tendiadiem', 'LIKE', "%$keyword%")->get();
        }
        else if($data['type_search'] == 'tentinhthanh')
        {
            $result = $this->model
                ->where('diachi.tinhthanh', 'LIKE', "%$keyword%")
                ->orWhere('diachi.quanhuyen', 'LIKE', "%$keyword%")
                ->orWhere('diachi.xaphuong', 'LIKE', "%$keyword%")
                ->get();
        }
        else if($data['type_search'] == 'giatien')
        {
            $result = $this->model
                ->whereBetween('dichvus.gia', [0, (float)$keyword])
                ->get();
        }
        
        // dd($result);
        return $result;
    }

    /**
     * @param array $data
     *
     * @return DiaDiem
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : DiaDiem
    {
        // dd($data);
        $DiaDiem = parent::create([
            'tendiadiem' => $data['tendiadiem'],
            'motangan' => $data['motangan'],
            'anhdaidien' => $data['anhdaidien'],
            'anhdaidien_blob' => $data['anhdaidien_blob'],
            'gioithieu' => $data['gioithieu'],
            'tukhoa' => $data['tukhoa'],
            'dienthoai' => $data['dienthoai'],
            'email' => $data['email'],
            'giomocua' => $data['giomocua'],
            'giodongcua' => $data['giodongcua'],
            'GPS' => $data['GPS'],
            'trangthai' => $data['trangthai']
        ]);
        
        $DiaDiem->diachi()->save($data['diachi']);

        foreach($data['dichvus'] as $key=>$value)
        {
            $DiaDiem->dichvus()->save($value);
        }

        if ($DiaDiem) {
            return $DiaDiem;
        }

        throw new GeneralException(__('exceptions.backend.access.DiaDiems.create_error'));
    }

    /**
     * @param DiaDiem  $DiaDiem
     * @param array $data
     *
     * @return DiaDiem
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(DiaDiem $DiaDiem, array $data) : DiaDiem
    {   
        if ($DiaDiem->update([
            'tendiadiem' => $data['tendiadiem'],
            'motangan' => $data['motangan'],
            'anhdaidien' => $data['anhdaidien'],
            'gioithieu' => $data['gioithieu'],
            'tukhoa' => $data['tukhoa'],
            'dienthoai' => $data['dienthoai'],
            'email' => $data['email'],
            'giomocua' => $data['giomocua'],
            'giodongcua' => $data['giodongcua'],
            'GPS' => $data['GPS'],
            'trangthai' => $data['trangthai']
        ])) {
            
            $DiaDiem->diachi()->save($data['diachi']);
            
            foreach($DiaDiem->dichvus as $key=>$value)
            {
                $DiaDiem->dichvus()->destroy($value);
            }

            foreach($data['dichvus'] as $key=>$value)
            {
                $DiaDiem->dichvus()->save($value);
            }
            
            return $DiaDiem;
        }

        throw new GeneralException(__('exceptions.backend.access.DiaDiems.update_error'));
    }

    /**
     * @param DiaDiem  $DiaDiem
     * @param array $data
     *
     * @return DiaDiem
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function createDanhGia(DiaDiem $DiaDiem, array $data) : DiaDiem
    {   
        $DiaDiem->danhgias()->save(new DanhGia([
            'email' => $data['email'], 
            'first_name' => $data['first_name'], 
            'last_name' => $data['last_name'], 
            'noidung' => $data['noidung'], 
            'diem' => $data['diem'], 
            'trangthai' => 0 //chưa duyệt
        ]));
        return $DiaDiem;

        throw new GeneralException(__('exceptions.backend.access.DiaDiems.update_error'));
    }

    /**
     * @param DiaDiem $DiaDiem
     *
     * @return DiaDiem
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(DiaDiem $DiaDiem) : DiaDiem
    {
        if (is_null($DiaDiem->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.DiaDiems.delete_first'));
        }

        // Delete associated relationships
        $DiaDiem->passwordHistories()->delete();
        $DiaDiem->providers()->delete();
        $DiaDiem->sessions()->delete();

        if ($DiaDiem->forceDelete()) {
            return $DiaDiem;
        }

        throw new GeneralException(__('exceptions.backend.access.DiaDiems.delete_error'));
    }

    /**
     * @param DiaDiem $DiaDiem
     *
     * @return DiaDiem
     * @throws GeneralException
     */
    public function restore(DiaDiem $DiaDiem) : DiaDiem
    {
        if (is_null($DiaDiem->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.DiaDiems.cant_restore'));
        }

        if ($DiaDiem->restore()) {
            return $DiaDiem;
        }

        throw new GeneralException(__('exceptions.backend.access.DiaDiems.restore_error'));
    }
}
