<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\Private\ServiceResource;
use App\Models\Service;
use App\Models\ServiceMeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(Service $service, ServiceMeta $serviceMeta)
    {
        // LÀM ƠN ĐỪNG SỬA GÌ TRONG ĐÂY CẢ
        $this->service = $service;
        $this->service_meta = $serviceMeta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // LÀM ƠN ĐỪNG SỬA GÌ TRONG ĐÂY CẢ
        try {
            $services = $this->service->with('serviceMeta')->paginate(10);
            return new ServiceResource($services);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        // LÀM ƠN ĐỪNG SỬA GÌ TRONG ĐÂY CẢ

        try {
            $service = $this->service->create([
                'title' => $request->title,
                'description' => $request->description,
                'service_start' => date("Y-m-d", strtotime($request->service_start)),
                'service_end' => date("Y-m-d", strtotime($request->service_end)),
                'price_base' => $request->price_base,
                'price_sale' => $request->price_sale,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
                'use_time' => $request->use_time,
            ]);
            foreach ($request->meta as $value) {
                $this->service_meta->create([
                    'service_id' => $service->id,
                    'meta_key' => $value['meta_key'],
                    'meta_value' => $value['meta_value'],
                ]);
            }


            return response()->json($service);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // LÀM ƠN ĐỪNG SỬA GÌ TRONG ĐÂY CẢ

        try {
            $result = $this->service->where('id', $id)->with('serviceMeta')->first();
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        try {
            $service = $this->service->findOrFail($id);
            $service->serviceMeta()->delete();
            $service->update([
                'title' => $request->title,
                'description' => $request->description,
                'service_start' => date("Y-m-d", strtotime($request->service_start)),
                'service_end' => date("Y-m-d", strtotime($request->service_end)),
                'price_base' => $request->price_base,
                'price_sale' => $request->price_sale,
                'status' => $request->status,
                'user_id' => $request->user_id,
                'use_time' => $request->use_time,
            ]);
            if (!empty($request->service_meta)) {
                foreach ($request->service_meta as $value) {
                    $this->service_meta->create([
                        'service_id' => $service->id,
                        'meta_key' => $value['meta_key'],
                        'meta_value' => $value['meta_value'],
                    ]);
                }
            }
            return response()->json($service);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // LÀM ƠN ĐỪNG SỬA GÌ TRONG ĐÂY CẢ
        try {
            $result = $this->service->findOrFail($id)->destroy($id);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
