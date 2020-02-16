<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Validator;

class PostController extends Controller
{
    public $successStatus = 200;
	
    public function data(Request $request) {
        try {
            $query = Post::query()
                    ->join('resource_person', 'post.resource_person_id', '=', 'resource_person.id')
                    ->join('mosque', 'post.mosque_id', '=', 'mosque.id')
                    ->join('city', 'mosque.city_id', '=', 'city.id')
					->join('country', 'country.id', '=', 'city.country_id')
                    ->select('post.*', 'mosque.fullname as mosque_name', 'country.fullname as country', 'resource_person.fullname as resource', 'city.fullname as city');
            $request['keyword'] = urldecode($request['keyword']);

            if (!empty($request['keyword'])) {
                $request['keyword'] = urldecode($request['keyword']);
                $query->where('city.fullname', 'like', "%{$request['keyword']}%");
                $query->orWhere('mosque.fullname', 'like', "%{$request['keyword']}%");
                $query->orWhere('resource_person.fullname', 'like', "%{$request['keyword']}%");
                $query->orWhere('post.text', 'like', "%{$request['keyword']}%");
            }

            if (!empty($request['user_id'])) {
                $query->where('post.user_id', '=', $request['user_id']);
            }

            if (!empty($request['city_id'])) {
                $query->where('mosque.city_id', '=', $request['city_id']);
            }
            
            if (!empty($request['cities'])) {				
                $query->whereIn('mosque.city_id',explode(",",  urldecode($request['cities'])) );
            }
            if (!empty($request['categories'])) {
                $query->whereIn('post.category_id', explode(",", urldecode($request['categories'])));
            }
            
            if (!empty($request['city'])) {
                $query->where('city.fullname', '=', $request['city']);
            }
			
			 if (!empty($request['country'])) {
                $query->where('country.fullname', '=', $request['country']);
            }

            if (!empty($request['mosque_id'])) {
                $query->where('post.mosque_id', '=', $request['mosque_id']);
            }

            if (!empty($request['order'])) {
                $query->orderBy($request['order'], $request['sort']);
            } else {
                $query->orderBy('post.post_time', 'desc');
            }
            $query->orderBy('post.updated_at', 'desc');
            $query->orderBy('post.created_at', 'desc');
			
            $count = $query->count();
            if (!empty($request['page']) && !empty($request['rows'])) {
				$start=($request['page']-1)*$request['rows'];
                $posts = $query->offset($start)
                        ->limit($request['rows'])
                        ->with('resource_person')
                        ->with('user')
                        ->with('category')
                        ->with('mosque')
                        ->with('image_mosque')
                        ->get();
            } else {
                $posts = $query->with('resource_person')
                        ->with('user')
                        ->with('category')
                        ->with('mosque')
                        ->with('image_mosque')
                        ->get();
            }
            $data = array(
                'status' => true,
                'data' => array(
                    'count' => $count,
                    'docs' => $posts
                )
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $this->successStatus);
        }
        return response()->json($data, $this->successStatus);
    }

}
