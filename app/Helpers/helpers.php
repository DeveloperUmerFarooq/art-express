<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('extractCityFromAddress')) {
    function extractCityFromAddress($address): ?string {
        $cities = config('pakistan.cities');

        foreach ($cities as $city) {
            if (stripos($address, $city) !== false) {
                return $city;
            }
        }

        return null;
    }
}

if (!function_exists('getCoordinates')) {
    function getCoordinates(string $city): ?array {
        $response = Http::get('https://api.openrouteservice.org/geocode/search', [
            'api_key' => config('services.ors.key'),
            'text' => $city,
            'size' => 1,
        ]);

        $data = $response->json();

        if (isset($data['features'][0]['geometry']['coordinates'])) {
            return $data['features'][0]['geometry']['coordinates'];
        }

        return null;
    }
}

if (!function_exists('getDistanceInKm')) {
    function getDistanceInKm(array $fromCoords, array $toCoords): ?float {
        $response = Http::withHeaders([
            'Authorization' => config('services.ors.key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openrouteservice.org/v2/matrix/driving-car', [
            'locations' => [$fromCoords, $toCoords],
            'metrics' => ['distance'],
        ]);

        $data = $response->json();

        if (isset($data['distances'][0][1])) {
            return round($data['distances'][0][1] / 1000, 2);
        }

        return null;
    }
}


if (!function_exists('deliverCharge')) {
    function deliverCharge($distanceKm) {
        $baseFee = config('delivery.base_fee');
        $ratePerKm = config('delivery.rate_per_km');
        if($distanceKm>0){
            return $baseFee + ($distanceKm * $ratePerKm);
        }else{
            return $baseFee+250;
        }
    }
}
