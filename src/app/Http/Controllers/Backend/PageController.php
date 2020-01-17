<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\PageRepository;
use App\Http\Requests\Backend\Page\StorePageRequest;
use App\Http\Requests\Backend\Page\ManagePageRequest;
use App\Http\Requests\Backend\Page\UpdatePageRequest;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $PageRepository;

    /**
     * PageController constructor.
     *
     * @param PageRepository $PageRepository
     */
    public function __construct(PageRepository $PageRepository)
    {
        $this->PageRepository = $PageRepository;
    }

    /**
     * @param ManagePageRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManagePageRequest $request)
    {
        return view('backend.pages.index')
            ->with('pages', $this->PageRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManagePageRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManagePageRequest $request)
    {
        return view('backend.pages.create');
    }

    /**
     * @param StorePageRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StorePageRequest $request)
    {
        $this->PageRepository->create($request->only(
            'title',
            'slug',
            'content',
            'keyword'
        ));

        return redirect()->route('admin.pages.index')->withFlashSuccess('Thêm mới Trang thành công!');
    }

    /**
     * @param ManagePageRequest $request
     * @param Page              $Page
     *
     * @return mixed
     */
    public function show(ManagePageRequest $request, $_id)
    {
        $Page = Page::find($_id);
        return view('backend.pages.show')
            ->with('page', $Page);
    }

    /**
     * @param ManagePageRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param Page                 $Page
     *
     * @return mixed
     */
    public function edit(ManagePageRequest $request, $_id)
    {
        $Page = Page::find($_id);
        return view('backend.pages.edit')
            ->with('page', $Page);
    }

    /**
     * @param UpdatePageRequest $request
     * @param Page              $Page
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdatePageRequest $request, $_id)
    {
        $Page = Page::find($_id);
        $this->PageRepository->update($Page, $request->only(
            'title',
            'slug',
            'content',
            'keyword'
        ));

        return redirect()->route('admin.pages.index')->withFlashSuccess('Sửa Trang thành công!');
    }

    /**
     * @param ManagePageRequest $request
     * @param Page              $Page
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManagePageRequest $request, $_id)
    {
        $this->PageRepository->deleteById($_id);

        return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.deleted'));
    }
}
