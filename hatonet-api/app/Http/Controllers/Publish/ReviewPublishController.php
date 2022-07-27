<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Product;
use App\Models\Rating;
class ReviewPublishController extends Controller
{
    public function __construct(User $user, UserMeta $userMeta, Rating $rating,Product $product)
    {
        $this->User = $user;
        $this->rating = $rating;
        $this->UserMeta = $userMeta;
        $this->Product = $product;
    }
    public function index(Request $request){
        $company_id = null;
        $idCompany = $request->idCompany  ? $request->idCompany : null ;
        $idProduct = $request->idProduct  ? $request->idProduct : null ;
        $idUser = $request->idUser  ? $request->idUser : null ;
        if($idCompany){
            $rating = Rating::where('company_id', '!=' , $company_id )->get();
            $rating->load('user');
            $reviewRating = Rating::where('user_id',  $idUser)->where('company_id',  $idCompany)->where('parent' , 1)->first();
            $result = is_null($reviewRating) ? false : $reviewRating; 
            return response()->json([
                'reviews'=> $rating,
                'reviewRating' => $result] ,200);
        }else{
                $rating = Rating::where('product_id', '!=' , $company_id )->get();
                $rating->load('user');
                $reviewRating = Rating::where('user_id',  $idUser)->where('product_id',  $idProduct)->where('parent' , 1)->first();
                $result = is_null($reviewRating) ? false : $reviewRating; 
                return response()->json([
                    'reviews'=> $rating,
                    'reviewRating' => $result] ,200);
        }
       
    }
    public function show(Request $request ,$id){
        try {
            $rating = $this->rating->findOrFail($id);
            return response()->json($rating,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function store(Request $request){
        $idCompany = $request->idCompany  ? $request->idCompany : null ;
        $idProduct = $request->idProduct  ? $request->idProduct : null ;
        if($idCompany){
            $user = User::find($idCompany);
            $user->rating = number_format(Rating::all()->where('company_id', $idCompany)->avg('rating') , 2);
            $user->save();
            $rating =  $this->rating->create($request->all());
            return response()->json($rating  ,200);
        }else{
            $user = User::find($idProduct);
            $user->rating = number_format(Rating::all()->where('product_id',  $idProduct)->avg('rating') , 2);
            $user->save();
            $rating =  $this->rating->create($request->all());
            return response()->json($rating  ,200);
        }
       
    }
    public function update(Request $request ,$id){
        // try {
            $rating = $this->rating->findOrFail($id);
            $rating->update($request->all());
            $rating->load('user');   
            return response()->json($rating  ,200);
        // } catch (\Throwable$th) {
        //     return response()->json(['message' => $th], 403);
        // }
    }
    public function destroy($id){
        try {
            $rating = $this->rating->findOrFail($id)->destroy($id);
            return response()->json($rating, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => $th], 403);
        }
    }
}
