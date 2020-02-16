<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoryController extends Controller {

    public $successStatus = 200;

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'fullname' => 'required|min:6',
                    'description' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
        try {
            $input = $request->all();
            if (isset($input['id'])) {
                $city = Category::FindOrFail(['id' => $input['id']])->first();
                $city->fullname = $input['fullname'];
                $city->description = $input['description'];
                $city->update();
            } else {
                $city = new Category();
                $city->fullname = $input['fullname'];
                $city->description = $input['description'];
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

    public function data(Request $request) {
        try {
            $query = Category::query();
            $request['keyword'] = urldecode($request['keyword']);
            if (!empty($request['keyword'])) {
                $request['keyword'] = urldecode($request['keyword']);
                $query->where('category.fullname', 'like', "%{$request['keyword']}%");
            }

            if (!empty($request['order'])) {
                $query->orderBy($request['order'], $request['sort']);
            }

            $query->orderBy('fullname', 'asc');

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

    public function detail($id) {
        try {
            $keyword = array(
                'id' => $id
            );
            $category = Category::FindOrFail($keyword)->first();
            $data = array(
                'status' => true,
                'data' => $category
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

    public function destroy(Request $request) {
        try {
            $city = Category::FindOrFail($request->id);
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
