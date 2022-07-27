<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;

class ApiController extends Controller
{

    protected static function isAdmin()
    {
        return Auth::user()->roles === "admin";
    }

    protected static function isCustomer()
    {
        return Auth::user()->roles === "customer";
    }

    protected static function isMember()
    {
        return Auth::user()->roles === "member";
    }

    //
    protected static function hasUserId()
    {
        // return Auth::user()->id;
        // var_dump($this);
    }

    public static function timeNow()
    {
        return Carbon::now();
    }

    /**
     * Convert time to string
     */
    protected static function timeString($time)
    {
        return Carbon::parse($time)->toDateTimeString();
    }

    /**
     * Resize Image
     * https://image.intervention.io/v2/introduction/installation
     */
    protected static function resizeImage($path, $filename)
    {
        $img = Image::make($path)->resize(300, 200);
        return $img->response('jpg');
    }

    /**
     * Create Meta
     */
    protected static function createMeta($key = null , $value) {
        //
    }
}
