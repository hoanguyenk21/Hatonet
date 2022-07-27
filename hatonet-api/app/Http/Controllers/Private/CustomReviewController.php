<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer_reviews;
class CustomReviewController extends Controller
{
    public function __construct(Customer_reviews $customer_reviews)
    {
        $this->customer_reviews = $customer_reviews;
    }
    public function index(){
        $data = Customer_reviews::orderBy('created_at','desc')->paginate(5);
        return response()->json($data,200);
    }
    public function show($id){
        try {
            $data = $this->customer_reviews->findOrFail($id);
            return response()->json($data,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function destroy($id){
        try {
            $data = $this->customer_reviews->findOrFail($id)->destroy($id);
        return response()->json($data, 200);   
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }   
}
