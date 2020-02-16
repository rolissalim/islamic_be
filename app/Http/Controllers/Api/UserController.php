<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Country;

class UserController extends Controller
{
    public $successStatus = 200;

    public function detail($id){
        $status=false;
        $user=User::findOrFail($id)
            ->with("cities")
            ->first();
        $user->country=Country::findOrFail($user->cities[0])->first();
        $data = array(
            'status' => true,
            'data' => $user
        );
        return response()->json($data, $this->successStatus);
    }
}
