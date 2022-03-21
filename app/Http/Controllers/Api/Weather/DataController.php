<?php

namespace App\Http\Controllers\Api\Weather;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Location;

class DataController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $rules = array(
            'city' => 'required|string|exists:locations,city',
            'date' => 'nullable|date|date_format:Y-m-d'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()){

            $location = Location::where('city', $request->city)->first();
            $weatherLocation = $location->getWeather($request->date);

            if($weatherLocation['status']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Weather of ' . $location->city . ' ('.(($request->date) ? $request->date : date('Y-m-d')).') get with success.',
                    'details' => $location->getWeather($request->date),
                ]);
            }
        }

        if ($validator->fails()){
            return response()->json(['status' => false, 'message' => 'There was an error in your request.', 'errors' => $validator->messages()], 400);
        }

        return response()->json(['status' => false, 'message' => 'We did not find the weather for the given city.'], 400);
    }
}
