<?php
namespace App\Services\Admin\DriverServices;

use App\Models\User;
use App\Models\UserImage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class StoreService{
    public function store($request){
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads/user/images/' . $request->username . '_' . time(), ['disk' => 'public']);
        }
        $role = 'driver';
        $db_role = Role::where('name', $role)->first();
        DB::beginTransaction();
        try {
            $driver = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt('123456789'),
            ]);
            $driver->assignRole($db_role);

            $driver_image = UserImage::create([
                'image' => $image,
                'user_id' => $driver->id
            ]);



            DB::commit();
            return Redirect::route('admin.driver.index')->with('success', 'driver created successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('daily')->info('store driver'. $e->getMessage());
        }
    }
}