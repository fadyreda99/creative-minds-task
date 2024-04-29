<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Models\UserImage;
use App\Services\Admin\UserServices\CreateService;
use App\Services\Admin\UserServices\DestroyService;
use App\Services\Admin\UserServices\EditService;
use App\Services\Admin\UserServices\IndexService;
use App\Services\Admin\UserServices\StoreService;
use App\Services\Admin\UserServices\UpdateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $indexService;
    private $createService;
    private $storeService;
    private $editService;
    private $updateService;
    private $destroyService;

    public function __construct(
        IndexService $indexService,
        CreateService $createService,
        StoreService $storeService,
        EditService $editService,
        UpdateService $updateService,
        DestroyService $destroyService
    ) {
        $this->indexService = $indexService;
        $this->createService = $createService;
        $this->storeService = $storeService;
        $this->editService = $editService;
        $this->updateService = $updateService;
        $this->destroyService = $destroyService;
    }
    public function index()
    {
        return $this->indexService->index();
    }

    public function create()
    {
        return $this->createService->create();
    }

    public function store(UserRequest $request)
    {
        return $this->storeService->store($request);
    }

    public function edit($user_id)
    {
        return $this->editService->edit($user_id);
    }

    public function update(UserRequest $request)
    {
        return $this->updateService->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->destroyService->destroy($request);
    }
}
