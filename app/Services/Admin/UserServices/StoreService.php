<?php
namespace App\Services\Admin\UserServices;

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
        $role = 'user';
        $db_role = Role::where('name', $role)->first();
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt('123456789'),
            ]);
            $user->assignRole($db_role);

            $user_image = UserImage::create([
                'image' => $image,
                'user_id' => $user->id
            ]);



            DB::commit();
            return Redirect::route('admin.user.index')->with('success', 'User created successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('daily')->info('store user'. $e->getMessage());
        }
    }
}