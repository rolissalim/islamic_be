<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\City;
use Illuminate\Support\Facades\DB;

class CityController extends Controller {

    public $successStatus = 200;

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'country' => 'required',
                    'fullname' => 'required|min:6',
                    'latitude' => 'required',
                    'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
        try {
            $input = $request->all();
            if (isset($input['id'])) {
                $city = City::FindOrFail(['id' => $input['id']])->first();
                $city->country_id = $input['country'];
                $city->fullname = $input['fullname'];
                $city->latitude = $input['latitude'];
                $city->longitude = $input['longitude'];
                $city->update();
            } else {
                $city = new City();
                $city->country_id = $input['country'];
                $city->fullname = $input['fullname'];
                $city->latitude = $input['latitude'];
                $city->longitude = $input['longitude'];
                $city->save();
            }
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
            $country = City::with('country')->FindOrFail($keyword)->first();
            $data = array(
                'status' => true,
                'data' => $country
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function data(Request $request) {        
        try {
            $query = City::query()
                    ->join('country', 'city.country_id', '=', 'country.id')
                    ->select('city.*', 'city.fullname  as name', 'country.fullname as country','country.timezone as timezone');
            $request['keyword'] = urldecode($request['keyword']);


            if (!empty($request['country_id'])) {
                $query->where('city.country_id', $request['country_id']);
            }

            if (!empty($request['country'])) {
                $query->where('country.fullname', $request['country']);
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
            if (!empty($request['keyword'])) {
                $keyword = urldecode($request['keyword']);
                $query->where(function($q) use ($keyword) {
                    $q->where('city.fullname', 'LIKE', "%{$keyword}%")
                            ->orWhere('country.fullname', 'LIKE', "%{$keyword}%");
                });
            }
            if (!empty($request['order'])) {
                $query->orderBy($request['order'], $request['sort']);
            }
            $query->orderBy('city.fullname', 'asc');
            $query->orderBy('country.fullname', 'asc');
            
            $count = $query->count();
            
            if (!empty($request['page']) && !empty($request['rows'])) {
                $start=($request['page']-1) * $request['rows']; 
                $citys = $query->offset($start)->limit($request['rows'])->get();
            } else {
                $citys = $query->get();
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
            $city = City::FindOrFail($request->id);
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
