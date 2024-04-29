<?php  
namespace App\Services\Admin\UserServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class EditService{
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user) {
            return view('admin.users.edit', compact('user'));
        }else{
            return Redirect::route('admin.user.index')->with('error', 'no found this user');
        }
    }
}