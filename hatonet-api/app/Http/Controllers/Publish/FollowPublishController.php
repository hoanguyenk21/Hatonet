<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowPublishController extends Controller
{
    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    public function index(Request $request)
    {  
        $follow= $this->follow->all();
        $followss= $this->follow->where('company_id', $request->idCompany)->where('user_id',$request->idUser)->first();
        return response()->json(['follow' =>$follow, 'followss' => $followss], 200);
        // return new TermResource(Term::paginate(25));
    }
}
