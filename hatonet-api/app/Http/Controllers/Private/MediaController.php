<?php

namespace App\Http\Controllers\Private;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Media\StoreMediaRequest;
use App\Http\Requests\Media\UpdateMediaRequest;

class MediaController extends ApiController
{

    /**
     * Construct
     */
    public function __construct(Media $media, Auth $auth)
    {
        $this->media = $media;
        $this->auth  = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMediaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media           $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media           $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaRequest $request
     * @param  \App\Models\Media                     $media
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        try {
            $result = $this->media->update($media, $request->all());
            return response()->json($result, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")],
                403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media           $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        try {
            $result = $this->media->findOrFail($media)->destroy($media);
            return response()->json($result, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")],
                403);
        }
    }

    /**
     * Upload Signle File
     */
    public function uploadFile(StoreMediaRequest $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'Không tồn tại file'],
                200);
        }
        // folder
        $folder = 'images';

        // handle save file
        $image = $request->file('image');
        $image->storeAs($folder, $image->getClientOriginalName(), 'local');
        return $image;
    }

}
