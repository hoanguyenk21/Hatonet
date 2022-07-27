<?php

namespace App\Http\Controllers\Publish;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Product;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Rating;
class UserPublishController extends Controller
{
    public function __construct(User $user, UserMeta $userMeta, Rating $rating,Product $product,Order $order)
    {
        $this->User = $user;
        $this->rating = $rating;
        $this->UserMeta = $userMeta;
        $this->Product = $product;
        $this->Order = $order;
    }

    public function index(Request $request)
    {
        try {     
            $user = $this->User->all(); 
            $user = $user->map(function ($query)
            {
                $query->count_product = $query->product->count() ?? 0;
                return $query;
            });
            $user = $user->map(function ($comment)
            {
                $comment->count_commnet = $comment->ratings->count() ?? 0;
                return $comment;
            });
            $user->load('meta','service');
            return response()->json($user,200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function show(Request $request,$id)
    {
        try {
            $user = $this->User->findOrFail($id);
            $user->load('meta');
            $user->load('ratings');
            // $user->with(
            //     array(
            //         'ratings' => function ($query) {
            //             $query->select('id', 'email', 'name')->with(
            //                 array(
            //                     'users' => function ($q) {
            //                         $q->select('name');
            //                     }
            //                 )
            //             );
            //         }
            //     )
            // );
            $userCount = Product::where('user_id',$id)->count();
            return response()->json([
                'user'=> $user,
                'userCount' => $userCount
            ],200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
