<?php

namespace App\Repositories\Backend;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\Backend\Auth\PageAccountActive;
use App\Notifications\Frontend\Auth\PageNeedsConfirmation;

/**
 * Class PageRepository.
 */
class PageRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Page::class;
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
     * @return Page
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Page
    {
        $Page = parent::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'keyword' => $data['keyword'],
        ]);

        if ($Page) {
            return $Page;
        }

        throw new GeneralException(__('exceptions.backend.access.Pages.create_error'));
    }

    /**
     * @param Page  $Page
     * @param array $data
     *
     * @return Page
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Page $Page, array $data) : Page
    {
        if ($Page->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'keyword' => $data['keyword'],
        ])) {
            return $Page;
        }

        throw new GeneralException(__('exceptions.backend.access.Pages.update_error'));
    }

    /**
     * @param Page $Page
     *
     * @return Page
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Page $Page) : Page
    {
        if (is_null($Page->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.Pages.delete_first'));
        }

        // Delete associated relationships
        $Page->passwordHistories()->delete();
        $Page->providers()->delete();
        $Page->sessions()->delete();

        if ($Page->forceDelete()) {
            return $Page;
        }

        throw new GeneralException(__('exceptions.backend.access.Pages.delete_error'));
    }

    /**
     * @param Page $Page
     *
     * @return Page
     * @throws GeneralException
     */
    public function restore(Page $Page) : Page
    {
        if (is_null($Page->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.Pages.cant_restore'));
        }

        if ($Page->restore()) {
            return $Page;
        }

        throw new GeneralException(__('exceptions.backend.access.Pages.restore_error'));
    }
}
