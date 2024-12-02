<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\CreateUsersCityRequest;
use App\Http\Requests\City\UpdateUsersCityRequest;
use App\Models\City;
use App\Models\User;

class CityController extends Controller
{
    public function index(string $city_id)
    {
        try {
            $users = User::where("city_id", $city_id)->get();
            if ($users->isEmpty()) {
                return response()->json(["message" => "لا يوجد بيانات"], 404);
            }
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
    public function create_user(CreateUsersCityRequest $request, string $city_id)
    {
        try {
            $RequestData = $request->validated();
            $city = City::find($city_id);
            if (is_null($city)) {
                return response()->json(["message" => "المدينة غير موجودة"], 404);
            }
            if ($request->hasFile("image")) {
                $image = request()->file("image");
                $extension = $image->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $imagedir = public_path("images/");
                $image->move($imagedir, $filename);
                $RequestData['image'] = $filename;
            }
            $RequestData['city_id'] = $city_id;
            $user = User::create($RequestData);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
    public function update_user(UpdateUsersCityRequest $request, string $user_id)
    {
        try {
            $RequestData = $request->validated();
            $user = User::find($user_id);
            if (is_null($user)) {
                return response()->json(["message" => "المستخدم غير موجود"], 404);
            }
            if ($request->hasFile("image")) {
                $oldImagePath = public_path("images/" . $user->image);
                if ($user->image && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $image = $request->file("image");
                $filename = time() . "." . $image->getClientOriginalExtension();
                $directory = public_path("images/");
                $image->move($directory, $filename);
                $RequestData['image'] = $filename;
            }
            $user->update($RequestData);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function destroy_user(string $city_id, string $user_id)
    {
        try {
            $city = City::find($city_id);
            if (is_null($city)) {
                return response()->json(["message" => "المدينة غير موجودة"], 404);
            }
            $user = User::find($user_id);
            if (is_null($user)) {
                return response()->json(["message" => "الطالب غير موجود"], 404);
            }
            if ($user->image and file_exists(public_path("images/" . $user->image))) {
                unlink(public_path("images/" . $user->image));
            }
            $user->delete();
            return response()->json(["message" => "تم حذف المستخدم"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
}
