<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    public function __construct(User $user, Rating $rating, Product $product)
    {
        $this->User = $user;
        $this->rating = $rating;
        $this->Product = $product;
    }
    public function index(Request $request)
    {
        $company_id = null;
        $idCompany = $request->idCompany  ? $request->idCompany : null;
        $idProduct = $request->idProduct  ? $request->idProduct : null;
        $idUser = Auth::user()->id  ? Auth::user()->id : null;
        if ($idCompany) {
            $rating = $this->rating->where('company_id', '!=', $company_id)->with('user')->get();
            $reviewRating = $this->rating->where('user_id',  $idUser)->where('company_id',  $idCompany)->where('parent', 1)->first();
            $result = is_null($reviewRating) ? false : $reviewRating;
            return response()->json([
                'reviews' => $rating,
                'reviewRating' => $result
            ], 200);
        } else {
            $rating = $this->rating->where('product_id', '!=', $company_id)->with('user')->get();
            $reviewRating = $this->rating->where('user_id',  $idUser)->where('product_id',  $idProduct)->where('parent', 1)->first();
            $result = is_null($reviewRating) ? false : $reviewRating;
            return response()->json([
                'reviews' => $rating,
                'reviewRating' => $result
            ], 200);
        }
    }
    public function show(Request $request, $id)
    {
        try {
            $rating = $this->rating->findOrFail($id);
            return response()->json($rating, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function store(Request $request)
    {
        $idCompany = $request->idCompany  ? $request->idCompany : null;
        $idProduct = $request->idProduct  ? $request->idProduct : null;
        if ($idCompany) {
            $user = $this->User->find($idCompany);
            $user->rating = number_format($this->rating->all()->where('company_id', $idCompany)->avg('rating'), 2);
            $user->save();
            $rating =  $this->rating->create($request->all());
            return response()->json($rating, 200);
        } else {
            $user = $this->User->find($idProduct);
            $user->rating = number_format($this->rating->all()->where('product_id',  $idProduct)->avg('rating'), 2);
            $user->save();
            $rating =  $this->rating->create($request->all());
            return response()->json($rating, 200);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $rating = $this->rating->findOrFail($id);
            $rating->update($request->all());
            $rating->load('user');
            return response()->json($rating, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 403);
        }
    }
    public function destroy($id)
    {
        try {
            $rating = $this->rating->findOrFail($id)->destroy($id);
            return response()->json($rating, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 403);
        }
    }
}
