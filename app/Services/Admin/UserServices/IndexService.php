<?php
namespace App\Services\Admin\UserServices;

use Spatie\Permission\Models\Role;

class IndexService{
    public function index(){
        $role = Role::where('name', 'user')->first();
        if ($role) {
            $users = $role->users()->get();
            return view('admin.users.index', compact('users'));
        }
    }
}