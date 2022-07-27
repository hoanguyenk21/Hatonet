<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct(User $user, Follow $follow)
    {
        $this->User = $user;
        $this->follow = $follow;
    }

    public function index(Request $request)
    {
        $company_id = null;
        $follow = $this->follow->where('company_id', '!=', $company_id)->get();
        $follow->load('user');
        return response()->json([
            'follow' => $follow,
        ], 200);
    }

    public function store(Request $request)
    {
        $idCompany = $request->idCompany  ? $request->idCompany : null;
        $follow =  $this->follow->create($request->all());
        return response()->json($follow, 200);
    }

    public function destroy($id){
        try {
            $follow = $this->follow->findOrFail($id)->destroy($id);
            return response()->json($follow, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => $th], 403);
        }
    }
}
