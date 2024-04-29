<?php

namespace App\Services\Api\DriverService;

use App\Http\Resources\Drivers\NearestDriversResource;
use App\Models\User;

class NearestDriverService
{

    public function nearestDriversToUser()
    {
        $user = auth()->user();
        if ($user && $user->location) {
            $user_location = $user->location;
            $drivers = User::with('location')->whereHas('roles', function ($query) {
                $query->where('name', 'driver');
            })->get();

            $nearest_drivers = [];
            foreach ($drivers as $driver) {
                if ($user_location->lat && $user_location->lang && $driver->location && $driver->location->lat && $driver->location->lang) {
                    $distance = calculateDistance($user_location->lat, $user_location->lang, $driver->location->lat, $driver->location->lang);
                    $formatted_distance = number_format($distance, 2);
                    if ($formatted_distance <= 1) {
                        $nearest_drivers[] = [
                            'id' => $driver->id,
                            'phone' => $driver->phone,
                            'email' => $driver->email,
                            'name' => $driver->username,
                            'dist' => $formatted_distance
                        ];
                    }
                }
            }

            if (!empty($nearest_drivers)) {
                $nearestDriversCollection = collect($nearest_drivers);
                return NearestDriversResource::collection($nearestDriversCollection);
            } else {
                return response()->json(['message' => 'No drivers found within 1 km'], 404);
            }
        } else {
            return response()->json(['message' => 'User location not found'], 404);
        }
    }
}
