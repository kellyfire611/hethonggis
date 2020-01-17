<?php

namespace App\Repositories\Backend;

use App\Models\TinhThanh;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\TinhThanhAccountActive;
use App\Notifications\Frontend\Auth\TinhThanhNeedsConfirmation;

/**
 * Class TinhThanhRepository.
 */
class TinhThanhRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return TinhThanh::class;
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
     * @param array $data
     *
     * @return TinhThanh
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : TinhThanh
    {
        $TinhThanh = parent::create([
            'tentinhthanh' => $data['tentinhthanh'],
        ]);

        if ($TinhThanh) {
            return $TinhThanh;
        }

        throw new GeneralException(__('exceptions.backend.access.TinhThanhs.create_error'));
    }

    /**
     * @param TinhThanh  $TinhThanh
     * @param array $data
     *
     * @return TinhThanh
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(TinhThanh $TinhThanh, array $data) : TinhThanh
    {
        if ($TinhThanh->update([
            'tentinhthanh' => $data['tentinhthanh']
        ])) {
            return $TinhThanh;
        }

        throw new GeneralException(__('exceptions.backend.access.TinhThanhs.update_error'));
    }

    /**
     * @param TinhThanh $TinhThanh
     *
     * @return TinhThanh
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(TinhThanh $TinhThanh) : TinhThanh
    {
        if (is_null($TinhThanh->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.TinhThanhs.delete_first'));
        }

        // Delete associated relationships
        $TinhThanh->passwordHistories()->delete();
        $TinhThanh->providers()->delete();
        $TinhThanh->sessions()->delete();

        if ($TinhThanh->forceDelete()) {
            return $TinhThanh;
        }

        throw new GeneralException(__('exceptions.backend.access.TinhThanhs.delete_error'));
    }

    /**
     * @param TinhThanh $TinhThanh
     *
     * @return TinhThanh
     * @throws GeneralException
     */
    public function restore(TinhThanh $TinhThanh) : TinhThanh
    {
        if (is_null($TinhThanh->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.TinhThanhs.cant_restore'));
        }

        if ($TinhThanh->restore()) {
            return $TinhThanh;
        }

        throw new GeneralException(__('exceptions.backend.access.TinhThanhs.restore_error'));
    }
}
