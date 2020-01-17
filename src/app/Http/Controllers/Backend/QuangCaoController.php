<?php

namespace App\Http\Controllers\Backend;

use App\Models\QuangCao;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\QuangCaoRepository;
use App\Http\Requests\Backend\QuangCao\StoreQuangCaoRequest;
use App\Http\Requests\Backend\QuangCao\ManageQuangCaoRequest;
use App\Http\Requests\Backend\QuangCao\UpdateQuangCaoRequest;

/**
 * Class QuangCaoController.
 */
class QuangCaoController extends Controller
{
    /**
     * @var QuangCaoRepository
     */
    protected $QuangCaoRepository;

    /**
     * QuangCaoController constructor.
     *
     * @param QuangCaoRepository $QuangCaoRepository
     */
    public function __construct(QuangCaoRepository $QuangCaoRepository)
    {
        $this->QuangCaoRepository = $QuangCaoRepository;
    }

    /**
     * @param ManageQuangCaoRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageQuangCaoRequest $request)
    {
        return view('backend.quangcaos.index')
            ->with('quangcaos', $this->QuangCaoRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageQuangCaoRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageQuangCaoRequest $request)
    {
        return view('backend.quangcaos.create');
    }

    /**
     * @param StoreQuangCaoRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreQuangCaoRequest $request)
    {
        $inputs = $request->only(
            'tenquangcao',
            'kieu',
            'anhdaidien',
            'url'
        );

        $anhdaidien_file;
        if($request->hasFile('anhdaidien_file'))
        {
            $upload_dir = 'uploads/ads/img/' . date("Y") . '/' . date("m") . "/";
            $file     = $request->anhdaidien_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['anhdaidien'] = $filePath;
        }
        else
        {
            $inputs['anhdaidien'] = null;
        }

        $this->QuangCaoRepository->create($inputs);

        return redirect()->route('admin.quangcaos.index')->withFlashSuccess('Thêm mới Quảng cáo thành công!');
    }

    /**
     * @param ManageQuangCaoRequest $request
     * @param QuangCao              $QuangCao
     *
     * @return mixed
     */
    public function show(ManageQuangCaoRequest $request, $_id)
    {
        $QuangCao = QuangCao::find($_id);
        return view('backend.quangcaos.show')
            ->with('quangcao', $QuangCao);
    }

    /**
     * @param ManageQuangCaoRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param QuangCao                 $QuangCao
     *
     * @return mixed
     */
    public function edit(ManageQuangCaoRequest $request, $_id)
    {
        $QuangCao = QuangCao::find($_id);
        return view('backend.quangcaos.edit')
            ->with('quangcao', $QuangCao);
    }

    /**
     * @param UpdateQuangCaoRequest $request
     * @param QuangCao              $QuangCao
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateQuangCaoRequest $request, $_id)
    {
        $QuangCao = QuangCao::find($_id);
        $inputs = $request->only(
            'tenquangcao',
            'kieu',
            'anhdaidien',
            'url'
        );
        
        $anhdaidien_file;
        if($request->hasFile('anhdaidien_file'))
        {
            $upload_dir = 'uploads/ads/img/' . date("Y") . '/' . date("m") . "/";
            $file     = $request->anhdaidien_file;
            $fileName = rand(1, 999) . $file->getClientOriginalName();
            $filePath = $upload_dir  . $fileName;
            
            $file->storeAs('public/' . $upload_dir, $fileName);
            $inputs['anhdaidien'] = $filePath;
        }
        else
        {
            $inputs['anhdaidien'] = null;
        }
        
        $this->QuangCaoRepository->update($QuangCao, $inputs);

        return redirect()->route('admin.quangcaos.index')->withFlashSuccess('Sửa Quảng cáo thành công!');
    }

    /**
     * @param ManageQuangCaoRequest $request
     * @param QuangCao              $QuangCao
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageQuangCaoRequest $request, $_id)
    {
        $this->QuangCaoRepository->deleteById($_id);

        return redirect()->route('admin.tinhthanh.index')->withFlashSuccess(__('alerts.backend.tinhthanh.deleted'));
    }
}
