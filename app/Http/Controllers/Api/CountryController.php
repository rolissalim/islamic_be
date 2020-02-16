<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use Validator;

class CountryController extends Controller {

    public $successStatus = 200;

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'fullname' => 'required|min:6|unique:country',
                    'latitude' => 'required',
                    'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
        $input = $request->all();
        try {
            if (isset($input['id'])) {
                $country = Country::FindOrFail(['id' => $input['id']])->first();
                $country->fullname = $input['fullname'];
                $country->latitude = $input['latitude'];
                $country->longitude = $input['longitude'];
                $country->update();
            } else {
                $country = new Country();
                $country->id = $input['id'];
                $country->fullname = $input['fullname'];
                $country->latitude = $input['latitude'];
                $country->longitude = $input['longitude'];
                $country->save();
            }
            $data = array(
                'status' => true,
                'data' => $input
            );
            return response()->json($data, $this->successStatus);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
    }

    public function detail($id) {
        try {
            $keyword = array(
                'id' => $id
            );
            $country = Country::FindOrFail($keyword)->first();
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
            $query = Country::query();
            $request['keyword'] = urldecode($request['keyword']);
            if (!empty($request['keyword'])) {
                $query->where('fullname', 'like', "%{$request['keyword']}%");
            }
            if (!empty($request['fullname'])) {
                $query->where('fullname', '=', $request['fullname']);
            }
            $count = $query->count();

            if (!empty($request['order'])) {
                $query->orderBy('fullname', 'asc');
            }
            
            $query->orderBy('fullname', 'asc');

            if (!empty($request['page']) && !empty($request['rows'])) {
                $start=($request['page']-1) * $request['rows']; 
                $countries = $query->offset($start)->limit($request['rows'])->get();
            } else {
                $countries = $query->get();
            }
            $data = array(
                'status' => true,
                'data' => array(
                    'count' => $count,
                    'docs' => $countries
                )
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function destroy(Request $request) {
        try {
            $country = Country::FindOrFail($request->id);
            $country->delete();
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
