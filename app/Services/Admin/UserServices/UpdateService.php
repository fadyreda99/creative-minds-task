<?php
namespace App\Services\Admin\UserServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UpdateService{
    public function update($request){
        $user = User::findOrFail($request->user_id);
        if ($user) {
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return Redirect::route('admin.user.edit', ['user_id' => $user->id])->with('success', 'User updated successfully.');
        }
    }
}