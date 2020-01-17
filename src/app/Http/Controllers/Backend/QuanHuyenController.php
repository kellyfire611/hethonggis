<?php

namespace App\Http\Controllers\Backend;

use App\Models\QuanHuyen;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\QuanHuyenRepository;
use App\Http\Requests\Backend\QuanHuyen\StoreQuanHuyenRequest;
use App\Http\Requests\Backend\QuanHuyen\ManageQuanHuyenRequest;
use App\Http\Requests\Backend\QuanHuyen\UpdateQuanHuyenRequest;

/**
 * Class QuanHuyenController.
 */
class QuanHuyenController extends Controller
{
    /**
     * @var QuanHuyenRepository
     */
    protected $QuanHuyenRepository;

    /**
     * QuanHuyenController constructor.
     *
     * @param QuanHuyenRepository $QuanHuyenRepository
     */
    public function __construct(QuanHuyenRepository $QuanHuyenRepository)
    {
        $this->QuanHuyenRepository = $QuanHuyenRepository;
    }

    /**
     * @param ManageQuanHuyenRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageQuanHuyenRequest $request)
    {
        return view('backend.quanhuyen.index')
            ->with('tinhthanhs', $this->QuanHuyenRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageQuanHuyenRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageQuanHuyenRequest $request)
    {
        return view('backend.quanhuyen.create');
    }

    /**
     * @param StoreQuanHuyenRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreQuanHuyenRequest $request)
    {
        $this->QuanHuyenRepository->create($request->only(
            'tentinhthanh'
        ));

        return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.created'));
    }

    /**
     * @param ManageQuanHuyenRequest $request
     * @param QuanHuyen              $QuanHuyen
     *
     * @return mixed
     */
    public function show(ManageQuanHuyenRequest $request, $_id)
    {
        $QuanHuyen = QuanHuyen::find($_id);
        return view('backend.tinhthanh.show')
            ->with('tinhthanh', $QuanHuyen);
    }

    /**
     * @param ManageQuanHuyenRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param QuanHuyen                 $QuanHuyen
     *
     * @return mixed
     */
    public function edit(ManageQuanHuyenRequest $request, $_id)
    {
        $QuanHuyen = QuanHuyen::find($_id);
        return view('backend.tinhthanh.edit')
            ->with('tinhthanh', $QuanHuyen);
    }

    /**
     * @param UpdateQuanHuyenRequest $request
     * @param QuanHuyen              $QuanHuyen
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateQuanHuyenRequest $request, $_id)
    {
        $QuanHuyen = QuanHuyen::find($_id);
        $this->QuanHuyenRepository->update($QuanHuyen, $request->only(
            'tentinhthanh'
        ));

        return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.updated'));
    }

    /**
     * @param ManageQuanHuyenRequest $request
     * @param QuanHuyen              $QuanHuyen
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageQuanHuyenRequest $request, $_id)
    {
        $this->QuanHuyenRepository->deleteById($_id);

        return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.deleted'));
    }
}
