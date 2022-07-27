<?php

namespace App\Http\Controllers\Private;
use App\Models\Notify;
use App\Models\User;
use App\Events\NotifyEvent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Private\NotifyResource;
use App\Http\Requests\Notify\StoreNotifyRequest;
use App\Http\Requests\Notify\UpdateNotifyRequest;
use Illuminate\Http\Request;
class NotifyController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noti= Notify::orderBy('id', 'DESC')->get();
        return response()->json($noti, 200);
    }
    public function listst()
    {
        $noti= User::where('id', '<>', 1)->get();

        return response()->json($noti, 200);
    }
    public function updates(Request $request, $id){
        try {
            $notify = Notify::find($id)  ->update(['actision' => 1]);
            return response()->json($notify, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function search($title){
        $data = Notify::where('title', 'like' , '%'.$title.'%')->get();
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotifyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotifyRequest $request)
    {   $notify = new Notify;
        $notify= notify::create($request->all());
        $notify->save();
        return response()->json($notify , 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notify          $notify
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notify = $this->notify->findOrFail($id);
        $notify->load('user');

        return response()->json($notify,200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notify          $notify
     * @return \Illuminate\Http\Response
     */
    public function edit(Notify $notify)
    {
    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotifyRequest $request
     * @param  \App\Models\Notify                     $notify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $notify = Notify::find($id);

            $notify->update($request->all());
            return response($notify, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notify          $notify
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $notify = $this->notify->findOrFail($id)->destroy($id);
            return response()->json($notify, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")],
                403);
        }
    }
}
