<?php

 function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'km')
    {
        $earthRadius = ($unit === 'km') ? 6371 : 3959; // Radius of the earth in kilometers or miles

        $latDiff = deg2rad($latitude2 - $latitude1);
        $lonDiff = deg2rad($longitude2 - $longitude1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
            sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in selected unit (km or miles)

        return $distance;
    }