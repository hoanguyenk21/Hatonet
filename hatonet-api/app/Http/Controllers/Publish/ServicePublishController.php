<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Private\ServiceResource;
use App\Models\Service;
use App\Models\ServiceMeta;
use Illuminate\Http\Request;

class ServicePublishController extends ApiController
{
    public function __construct(Service $service, ServiceMeta $serviceMeta)
    {
        $this->service = $service;
        $this->service_meta = $serviceMeta;
    }

    public function index()
    {
        try {
            $services = $this->service->with('serviceMeta')->paginate(10);
            return new ServiceResource($services);

        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function show($id)
    {
        try {
            $result = $this->service->where('id', $id)->with('serviceMeta')->first();
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
