<?php
namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Private\AuthResource;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => __("messages.logout")]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return new AuthResource($request->user());
    }
}
