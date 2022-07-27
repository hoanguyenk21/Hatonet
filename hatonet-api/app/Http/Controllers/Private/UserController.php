<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user, UserMeta $userMeta)
    {
        $this->User = $user;
        $this->UserMeta = $userMeta;
    }

    public function index()
    {
        try { 
            $user = $this->User->paginate(10);
            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function show(Request $request,$id)
    {
        try {
            $user = $this->User->with('meta')->findOrFail($id);
            $meta = [];
            foreach ($user->meta as $key => $item) {
                $metaKey = $item['meta_key'];
                $metaValue = $item['meta_value'];
                $meta[$metaKey] = $metaValue;
            } 
            $meta = (object) $meta;                                                                                            
            return response()->json([
                'user' => $user,
                'meta' => $meta,
            ],200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function update(Request $request, $id) 
    {
        try {
            $dataMeta = ((array) json_decode($request->meta));
            $dataUser = $request->all();
            $newAvatar = $request->image;
            $newBanner = $request->banner;
            unset($dataUser['meta'], 
            $dataUser['id'], 
            $dataUser['email_verified_at'], 
            $dataUser['avatar'], 
            $dataUser['banner'],  
            $dataUser['provider_id'],  
            $dataUser['created_at'],
            $dataUser['updated_at'],
            $dataUser['new_avatar']);
            $user = $this->User->findOrFail($id);
            $user->update($dataUser);
            $userMeta = $user->meta;
            foreach ($dataMeta as $key => $value) {
                $metaByKey = $userMeta->where('meta_key', $key)->first();
                if($metaByKey){
                    $metaByKey->meta_value = $value;
                    $metaByKey->save();
                }else{
                    $this->UserMeta->create([                  
                        'user_id' => $user->id,
                        'meta_key' => $key,
                        'meta_value' => json_encode($value),
                    ]);
                   
                }
            }
            if(!empty($newAvatar)){
                $imageName = time() . '.' . $newAvatar->getClientOriginalName();
                $newAvatar->move(public_path('/images/') , $imageName);
                $path = ('/images/' .$imageName);
                $dataUser['avatar'] = $path;
            }else{
                $dataUser['avatar'] = '/images/imagesav.png';
            }  
            if(!empty($newBanner)){
                $bannerName = time() . '.' . $newBanner->getClientOriginalName();
                $newBanner->move(public_path('/images/') , $bannerName);
                $path = ('/images/' .$bannerName);
                $dataUser['banner'] = $path;
            }else{
                $dataUser['banner'] = '/images/imagesav.png';
            }  
            $user->update($dataUser);
            return response()->json($user->with('meta'));
        } catch (\Throwable$th) {
            return response()->json(['message' => $th], 403);
        }
    }
}
