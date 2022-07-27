<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Models\Media;
use Illuminate\Http\Request;

class FileController extends ApiController
{

     /**
     * Construct
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }
    /**
     * Upload File
     */
    public function upload(Request $request)
    {
        // $taxonomy = Taxonomy::create([
        //     'name' => rand(1, 10),
        //     'description' => rand(1, 10),
        //     'slug' => rand(1, 10),
        //     'type' => "tickets",
        //     'parent' => 0,
        // ]);
        // var_dump($taxonomy);
    }

    public function remove(Request $request)
    {
        // var_dump($request);
    }
}
