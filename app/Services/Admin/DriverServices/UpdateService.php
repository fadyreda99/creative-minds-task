<?php
namespace App\Services\Admin\DriverServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UpdateService{
    public function update($request){
        $driver = User::findOrFail($request->driver_id);
        if ($driver) {
            $driver->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return Redirect::route('admin.driver.edit', ['driver_id' => $driver->id])->with('success', 'driver updated successfully.');
        }
    }
}