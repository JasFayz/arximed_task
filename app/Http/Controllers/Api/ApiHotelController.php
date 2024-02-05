<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiHotelController extends Controller
{
    public function index(Request $request)
    {

        $hotels = Hotel::query()
            ->whereName($request->query('name'))
            ->whereBedroom($request->query('bedrooms'))
            ->whereBathroom($request->query('bathrooms'))
            ->whereStorey($request->query('storeys'))
            ->whereGarage($request->query('garages'))
            ->wherePrice($request->query('price_range'))
            ->paginate();


        return response()->json([
            'hotels' => $hotels,
        ]);
    }
}
