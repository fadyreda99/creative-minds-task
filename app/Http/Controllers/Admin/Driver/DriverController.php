<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRequest;
use App\Models\User;
use App\Models\UserImage;
use App\Services\Admin\DriverServices\CreateService;
use App\Services\Admin\DriverServices\DestroyService;
use App\Services\Admin\DriverServices\EditService;
use App\Services\Admin\DriverServices\IndexService;
use App\Services\Admin\DriverServices\StoreService;
use App\Services\Admin\DriverServices\UpdateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DriverController extends Controller
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
        return  $this->createService->create();
    }

    public function store(DriverRequest $request)
    {
        return $this->storeService->store($request);
    }

    public function edit($driver_id)
    {
       return $this->editService->edit($driver_id);
    }

    public function update(DriverRequest $request)
    {
      return $this->updateService->update($request);
    }

    public function destroy(Request $request)
    {
       return $this->destroyService->destroy($request);
    }
}
