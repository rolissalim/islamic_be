<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City_user;

class City_userController extends Controller
{
    public $successStatus = 200;

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                    'cities' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
        try {
            $input = $request->all();
            $cities_of_user = new City_user();
            $cities_of_user->user_id = $input['user_id'];
            $cities_of_user->city_id = $input['city_id'];
            $cities_of_user->save();

            $data = array(
                'status' => true,
                'data' => $input
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function detail($id) {
        try {
            $keyword = array(
                'id' => $id
            );
            $cities_of_user = City_user::with('country')->FindOrFail($keyword)->first();
            $data = array(
                'status' => true,
                'data' => $cities_of_user
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function data(Request $request) {
        try {
            $query = City_user::query()
                    ->select('cities_of_user.*');
            $request['keyword'] = urldecode($request['keyword']);


            if (!empty($request['user_id'])) {
                $query->where('cities_of_user.user_id', $request['user_id']);
            }

            if (!empty($request['city'])) {
                $query->where('city.fullname', $request['city']);
            }

            if (!empty($request['cities'])) {
                $query->whereIn('city.id', explode(",", $request['cities']));
            }
            if (!empty($request['city_id'])) {
                $query->where('city.id', $request['city_id']);
            }
            
            if (!empty($request['order'])) {
                $query->orderBy($request['order'], $request['sort']);
            }

            $count = $query->count();

            if (!empty($request['page']) && !empty($request['rows'])) {
                $start = ($request['page'] - 1) * $request['rows'];
                $citys = $query->offset($start)->limit($request['rows'])->get();
            } else {
                $citys = $query->with('cities')               
                ->get();
            }

            $data = array(
                'status' => true,
                'data' => array(
                    'count' => $count,
                    'docs' => $citys
                )
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function destroy(Request $request) {
        try {
            $city = Cities_of_user::FindOrFail($request->id);
            $city->delete();
            $data = array(
                'status' => true,
                'data' => array()
            );
            return response()->json($data, $this->successStatus);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
    }

}
