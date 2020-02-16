<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;
use App\User;
use Hash;
use App\Country;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request) {
        $status = false;
        $validator = Validator::make($request->all(), [
                    'email' => 'required',
                    'password' => 'required|min:6',
        ]);
        $credential = $this->credentials($request);

        if ($validator->fails()) {
            if (!$request->email) {
                return response()->json(['message' => "Email or username or number handphone is required"], 200);
            }
            return response()->json(['message' => $validator->errors()->first()], 200);
        }
        try {
            if (!$token = JWTAuth::attempt($credential)) {
                return response()->json(['message' => 'Data not found'], 200);
            }
            $status = true;
        } catch (JWTException $e) {
            return response()->json(['message' => 'could not create token'], 200);
        }
        $auth = JWTAuth::user();      

        $user=User::findOrFail($auth->id)
            ->with("cities")
            ->first();
        $user->country=Country::findOrFail($user->cities[0])->first();

        $data = array(
            'status' => $status,
            'data' => $user,
            'token' => $token
        );
        return response()->json($data);
    }

    public function register(Request $request) {
        $valid = true;
        $status = false;
        $validator = Validator::make($request->all(), [
                    'fullname' => 'required|min:6',
                    'cities' => 'required',
                    'username' => 'required|min:6|unique:users',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                    'repassword' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 200);
        }
        DB::beginTransaction();
        $create_user = User::create([
                    'fullname' => $request->get('fullname'),
                    'username' => $request->get('username'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'api_token' => Hash::make($request->get('email')),
                    'role_user_id' => '3',
                    'status_account' => true
        ]);

        $user_id = User::where('username', $request->get('username'))->first()->id;
        
        $cities_id = explode(",", $request->get('cities'));

        foreach ($cities_id as $value) {
            $city = Cities_of_user::create([
                        'user_id' => $user_id,
                        'city_id' => $value,
            ]);

            if ($valid && !$city) {
                $valid = false;
            }
        }

        if ($valid) {
            $status = true;
            DB::commit();
        } else {
            DB::rollBack();
        }
        $token = JWTAuth::fromUser($create_user);

        $user=User::findOrFail($user_id)
            ->with("cities")
            ->first();
        $user->country=Country::findOrFail($user->cities[0])->first();
        
        $data = array(
            'status' => $status,
            'data' => $user,
            'token' => $token
        );
        return response()->json($data);
    }

    public function getAuthenticatedUser() {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['User Not Found'], 200);
            }
        } catch (Tymon\JWTAuthExceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuthExceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuthExceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    protected function credentials(Request $request) {
        if (is_numeric($request->get('email'))) {
            return ['phone' => $request->get('email'), 'password' => $request->get('password'), 'status_account' => true];
        } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password'), 'status_account' => true];
        }
        return ['username' => $request->get('email'), 'password' => $request->get('password'), 'status_account' => true];
    }

}
