<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use GuzzleHttp;
use App\Mosque;
use App\Imagemosque;

class MosqueController extends Controller {

    public $successStatus = 200;

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'city' => 'required',
                    'address' => 'required',
                    'fullname' => 'required|min:6',
                    'latitude' => 'required',
                    'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
        // Start transaction!
        DB::beginTransaction();
        try {
            $input = $request->all();
            if (isset($input['id'])) {
                $mosque = Mosque::FindOrFail(['id' => $input['id']])->first();
                $mosque->city_id = $input['city'];
                $mosque->fullname = $input['fullname'];
                $mosque->address = $input['address'];
                $mosque->phonenumber = $input['phonenumber'];
                $mosque->latitude = $input['latitude'];
                $mosque->longitude = $input['longitude'];
                $mosque->update();
            } else {
                $mosque = new Mosque();
                $mosque->city_id = $input['city'];
                $mosque->address = $input['address'];
                $mosque->phonenumber = $input['phonenumber'];
                $mosque->fullname = $input['fullname'];
                $mosque->latitude = $input['latitude'];
                $mosque->longitude = $input['longitude'];
                $mosque->save();
            }
            if (isset($input['image']) && $input['image'] != "") {
                $image_mosque = new Imagemosque();
                $image_mosque->mosque_id = $mosque->id;
                $image_mosque->path = $input['image'];
                $image_mosque->save();
            }

            $data = array(
                'status' => true,
                'data' => $input
            );
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        DB::commit();
        return response()->json($data, $this->successStatus);
    }

    public function detail($id) {
        try {
            $keyword = array(
                'id' => $id
            );
            $mosque = Mosque::with('city')->with('images')->FindOrFail($keyword)->first();
            $data = array(
                'status' => true,
                'data' => $mosque
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function data(Request $request) {
        try {
            $query = Mosque::query()
                    ->join('city', 'mosque.city_id', '=', 'city.id')
                    ->join('country', 'city.country_id', '=', 'country.id')
                    ->select('mosque.*', 'mosque.fullname  as name', 'country.fullname as country', 'city.fullname as city');
			
            if (!empty($request['keyword'])) {
			
                $keyword = urldecode($request['keyword']);
				
                $query->where(function($q) use ($keyword) {
                    $q->where('city.fullname', 'LIKE', "%{$keyword}%")
                            ->orWhere('mosque.address', 'LIKE', "%{$keyword}%")
                            ->orWhere('mosque.fullname', 'LIKE', "%{$keyword}%")
                            ->orWhere('country.fullname', 'LIKE', "%{$keyword}%");
                });
            }

            if (!empty($request['city_id'])) {
                $query->where('mosque.city_id', '=', $request['city_id']);
            }

            if (!empty($request['city'])) {
                $query->where('city.fullname', '=', $request['city']);
            }
            if (!empty($request['country'])) {
                $query->where('country.fullname', '=', $request['country']);
            }

            if (!empty($request['order'])) {
                $query->orderBy($request['order'], $request['sort']);
            }
            $query->orderBy('name', 'asc');
            $query->orderBy('city', 'asc');
            $query->orderBy('country', 'asc');

            $count = $query->count();
            if (!empty($request['page']) && !empty($request['rows'])) {
			$start=($request['page']-1)*$request['rows'];
                $mosques = $query->offset($start)->limit($request['rows'])->with('images')->get();
            } else {
                $mosques = $query->with('images')->get();
            }

            $data = array(
                'status' => true,
                'data' => array(
                    'count' => $count,
                    'docs' => $mosques
                )
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function destroy(Request $request) {
        try {
            $mosque = Mosque::FindOrFail($request->id);
            $mosque->delete();
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
