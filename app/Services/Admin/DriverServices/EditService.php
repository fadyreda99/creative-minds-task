<?php  
namespace App\Services\Admin\DriverServices;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class EditService{
    public function edit($driver_id)
    {
        $driver = User::findOrFail($driver_id);
        if ($driver) {
            return view('admin.drivers.edit', compact('driver'));
        }else{
            return Redirect::route('admin.driver.index')->with('error', 'no found this driver');
        }
    }
}