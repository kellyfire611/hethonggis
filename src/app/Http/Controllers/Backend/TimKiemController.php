<?php

namespace App\Http\Controllers\Backend;

use App\Models\TinhThanh;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Repositories\Backend\TimKiemRepository;
// use App\Http\Requests\Backend\TinhThanh\StoreTinhThanhRequest;
// use App\Http\Requests\Backend\TinhThanh\ManageTinhThanhRequest;
// use App\Http\Requests\Backend\TinhThanh\UpdateTinhThanhRequest;

/**
 * Class TimKiemController.
 */
class TimKiemController extends Controller
{
    // /**
    //  * @var TimKiemRepository
    //  */
    // protected $TimKiemRepository;

    // /**
    //  * TimKiemController constructor.
    //  *
    //  * @param TimKiemRepository $TimKiemRepository
    //  */
    // public function __construct(TimKiemRepository $TimKiemRepository)
    // {
    //     $this->TimKiemRepository = $TimKiemRepository;
    // }

    /**
     * @param ManageTinhThanhRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.timkiem.index');
            //->with('tinhthanhs', $this->TimKiemRepository->getActivePaginated(25, 'id', 'asc'));
    }

    // /**
    //  * @param ManageTinhThanhRequest    $request
    //  * @param RoleRepository       $roleRepository
    //  * @param PermissionRepository $permissionRepository
    //  *
    //  * @return mixed
    //  */
    // public function create(ManageTinhThanhRequest $request)
    // {
    //     return view('backend.tinhThanh.create');
    // }

    // /**
    //  * @param StoreTinhThanhRequest $request
    //  *
    //  * @return mixed
    //  * @throws \Throwable
    //  */
    // public function store(StoreTinhThanhRequest $request)
    // {
    //     $this->TimKiemRepository->create($request->only(
    //         'tentinhthanh'
    //     ));

    //     return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.created'));
    // }

    // /**
    //  * @param ManageTinhThanhRequest $request
    //  * @param TinhThanh              $TinhThanh
    //  *
    //  * @return mixed
    //  */
    // public function show(ManageTinhThanhRequest $request, $_id)
    // {
    //     $TinhThanh = TinhThanh::find($_id);
    //     return view('backend.tinhthanh.show')
    //         ->with('tinhthanh', $TinhThanh);
    // }

    // /**
    //  * @param ManageTinhThanhRequest    $request
    //  * @param RoleRepository       $roleRepository
    //  * @param PermissionRepository $permissionRepository
    //  * @param TinhThanh                 $TinhThanh
    //  *
    //  * @return mixed
    //  */
    // public function edit(ManageTinhThanhRequest $request, $_id)
    // {
    //     $TinhThanh = TinhThanh::find($_id);
    //     return view('backend.tinhthanh.edit')
    //         ->with('tinhthanh', $TinhThanh);
    // }

    // /**
    //  * @param UpdateTinhThanhRequest $request
    //  * @param TinhThanh              $TinhThanh
    //  *
    //  * @return mixed
    //  * @throws \App\Exceptions\GeneralException
    //  * @throws \Throwable
    //  */
    // public function update(UpdateTinhThanhRequest $request, $_id)
    // {
    //     $TinhThanh = TinhThanh::find($_id);
    //     $this->TimKiemRepository->update($TinhThanh, $request->only(
    //         'tentinhthanh'
    //     ));

    //     return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.updated'));
    // }

    // /**
    //  * @param ManageTinhThanhRequest $request
    //  * @param TinhThanh              $TinhThanh
    //  *
    //  * @return mixed
    //  * @throws \Exception
    //  */
    // public function destroy(ManageTinhThanhRequest $request, $_id)
    // {
    //     $this->TimKiemRepository->deleteById($_id);

    //     return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.deleted'));
    // }
}
