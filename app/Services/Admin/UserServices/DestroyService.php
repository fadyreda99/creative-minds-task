<?php
namespace App\Services\Admin\UserServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DestroyService{
    public function destroy($request){
        $user = User::findOrFail($request->user_id);
        if ($user) {
            if ($user->location) {
                $user->location->delete();
            }

            if ($user->fcmToken) {
                $user->fcmToken->delete();
            }

            if ($user->image) {
                $Path = $user->image->image;
                $imagePath = strstr($Path, 'uploads');
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $user->image->delete();
            }

            $user->delete();
            return Redirect::route('admin.user.index')->with('success', 'User deleted successfully.');
        } else {
            return Redirect::route('admin.user.index')->with('error', 'no found this user');
        }
    }
}