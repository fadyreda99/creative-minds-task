<?php
namespace App\Services\Admin\DriverServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DestroyService{
    public function destroy($request){
        $driver = User::findOrFail($request->driver_id);
        if ($driver) {
            if ($driver->location) {
                $driver->location->delete();
            }

            if ($driver->fcmToken) {
                $driver->fcmToken->delete();
            }

            if ($driver->image) {
                $Path = $driver->image->image;
                $imagePath = strstr($Path, 'uploads');
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $driver->image->delete();
            }

            $driver->delete();
            return Redirect::route('admin.driver.index')->with('success', 'driver deleted successfully.');
        } else {
            return Redirect::route('admin.driver.index')->with('error', 'no found this driver');
        }
    }
}