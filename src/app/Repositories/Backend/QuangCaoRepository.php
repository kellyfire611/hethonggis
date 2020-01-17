<?php

namespace App\Repositories\Backend;

use App\Models\QuangCao;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\QuangCaoAccountActive;
use App\Notifications\Frontend\Auth\QuangCaoNeedsConfirmation;

/**
 * Class QuangCaoRepository.
 */
class QuangCaoRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return QuangCao::class;
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
     * @return QuangCao
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : QuangCao
    {
        $QuangCao = parent::create([
            'tenquangcao' => $data['tenquangcao'],
            'kieu' => $data['kieu'],
            'anhdaidien' => $data['anhdaidien'],
            'url' => $data['url'],
        ]);

        if ($QuangCao) {
            return $QuangCao;
        }

        throw new GeneralException(__('exceptions.backend.access.QuangCao.create_error'));
    }

    /**
     * @param QuangCao  $QuangCao
     * @param array $data
     *
     * @return QuangCao
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(QuangCao $QuangCao, array $data) : QuangCao
    {
        if ($QuangCao->update([
            'tenquangcao' => $data['tenquangcao'],
            'kieu' => $data['kieu'],
            'anhdaidien' => $data['anhdaidien'],
            'url' => $data['url'],
        ])) {
            return $QuangCao;
        }

        throw new GeneralException(__('exceptions.backend.access.QuangCao.update_error'));
    }

    /**
     * @param QuangCao $QuangCao
     *
     * @return QuangCao
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(QuangCao $QuangCao) : QuangCao
    {
        if (is_null($QuangCao->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.QuangCao.delete_first'));
        }

        // Delete associated relationships
        $QuangCao->passwordHistories()->delete();
        $QuangCao->providers()->delete();
        $QuangCao->sessions()->delete();

        if ($QuangCao->forceDelete()) {
            return $QuangCao;
        }

        throw new GeneralException(__('exceptions.backend.access.QuangCao.delete_error'));
    }

    /**
     * @param QuangCao $QuangCao
     *
     * @return QuangCao
     * @throws GeneralException
     */
    public function restore(QuangCao $QuangCao) : QuangCao
    {
        if (is_null($QuangCao->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.QuangCao.cant_restore'));
        }

        if ($QuangCao->restore()) {
            return $QuangCao;
        }

        throw new GeneralException(__('exceptions.backend.access.QuangCao.restore_error'));
    }
}
