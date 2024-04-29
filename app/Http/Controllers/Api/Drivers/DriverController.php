<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Drivers\NearestDriversResource;
use App\Models\User;
use App\Services\Api\DriverService\NearestDriverService;
use Spatie\Permission\Models\Role;

class DriverController extends Controller
{
    private $nearestDriverService;
    public function __construct(NearestDriverService $nearestDriverService)
    {
        $this->middleware(['auth:api', 'verify']);

        $this->nearestDriverService =$nearestDriverService;
    }
    public function nearestDriversToUser()
    {
        return $this->nearestDriverService->nearestDriversToUser();
        // $user = auth()->user();
        // $user_location = $user->location;

        // $drivers = User::with('location')->whereHas('roles', function ($query) {
        //     $query->where('name', 'driver');
        // })->get();

        // $nearest_drivers = [];
        // foreach ($drivers as $driver) {
        //     $distance = $this->calculateDistance($user_location->lat, $user_location->lang, $driver->location->lat, $driver->location->lang);
        //     $formatted_distance = number_format($distance, 2);
        //     if ($formatted_distance <= 1) {
        //         $nearest_drivers[] = [
        //             'id' => $driver->id,
        //             'phone' => $driver->phone,
        //             'email' => $driver->email,
        //             'name' => $driver->username,
        //             'dist' => $formatted_distance
        //         ];
        //     }
        // }
        // $nearestDriversCollection = collect($nearest_drivers);

        // return NearestDriversResource::collection($nearestDriversCollection);
    }


    // public function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'km')
    // {
    //     $earthRadius = ($unit === 'km') ? 6371 : 3959; // Radius of the earth in kilometers or miles

    //     $latDiff = deg2rad($latitude2 - $latitude1);
    //     $lonDiff = deg2rad($longitude2 - $longitude1);

    //     $a = sin($latDiff / 2) * sin($latDiff / 2) +
    //         cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
    //         sin($lonDiff / 2) * sin($lonDiff / 2);
    //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    //     $distance = $earthRadius * $c; // Distance in selected unit (km or miles)

    //     return $distance;
    // }
}
