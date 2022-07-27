<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\apply;
use Egulias\EmailValidator\Result\Reason\Reason;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ApplyController extends Controller
{
    public function __construct(apply $apply)
    {
        $this->apply = $apply;
    }

    public function index()
    {
        try {
            $apply = $this->apply->paginate(10);
            return response()->json($apply);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function store(Request $request)
    {
        // try {
            $apply = new apply();
            $apply = apply::create($request->all());
            if ($request->has('avatar') && !empty($request->avatar)) {
                $avatarName = time() . '.' . $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('images/'), $avatarName);
                $path = ('/images/' . $avatarName);
                $apply->image = $path;
            } else {
                $apply->image = '/images/imagesav.png';
            }
            $apply->save();
            return response()->json($apply, 200);
    }
}
