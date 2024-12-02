<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\CreateCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Models\City;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $cities = City::get();
            if (count($cities) == 0) {
                return response()->json(["message" => "لا يوجد بيانات"], 404);
            }
            return response()->json(["message" => $cities], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function create_city(CreateCityRequest $request)
    {
        try {
            $requestData = $request->validated();
            $city = City::create($requestData);
            if (!$city) {
                return response()->json(["message" => "لم تتم العملية"], 404);
            }
            return response()->json($city, 201);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function update_city(UpdateCityRequest $request, string $city_id)
    {
        try {
            $requestData = $request->validated();
            $city = City::find($city_id);
            if (!$city) {
                return response()->json(["message" => "لا يوجد منطقه بهذه الاسم"], 404);
            }
            $city->update($requestData);
            return response()->json($city, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function destroy_city(string $city_id)
    {
        try {
            $city = City::find($city_id);
            if (!$city) {
                return response()->json(["message" => "لا يوجد منطقه بهذه الاسم"], 404);
            }
            $users = User::where('city_id', $city_id)->get();
            foreach ($users as $user) {
                if ($user->image && file_exists(public_path("images/" . $user->image))) {
                    unlink(public_path("images/" . $user->image));
                }
            }
            $city->delete();
            return response()->json(["message" => "تم حذف المدينة وجميع الصور المرتبطة"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
