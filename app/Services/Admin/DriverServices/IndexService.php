<?php
namespace App\Services\Admin\DriverServices;

use Spatie\Permission\Models\Role;

class IndexService{
    public function index(){
        $role = Role::where('name', 'driver')->first();
        if ($role) {
            $drivers = $role->users()->get();
            return view('admin.drivers.index', compact('drivers'));
        }
    }
}