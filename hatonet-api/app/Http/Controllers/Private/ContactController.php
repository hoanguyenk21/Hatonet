<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\MailRegister;
use App\Models\Product;

class ContactController extends ApiController
{
    public function __construct(MailRegister $mailregister)
    {
        $this->mailregister = $mailregister;
    }
    public function index(Request $request)
{
    $mailRegister= MailRegister::orderBy('id', 'DESC')->get();
    return response()->json($mailRegister, 200);
}

    public function show($id)
    {
        $notify = $this->mailregister->findOrFail($id);

        return response()->json($notify,200);
    }

    public function destroy($id)
    {
        try {
            $term = $this->mailregister->findOrFail($id)->destroy($id);
            return response()->json($term, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")],
                403);
        }
    }
    public function search($title){
        $data = Term::where('title', 'like' , '%'.$title.'%')->get();
        return $data;
    }
}
