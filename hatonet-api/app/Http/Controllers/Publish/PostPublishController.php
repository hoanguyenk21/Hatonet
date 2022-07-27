<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Publish\PostPublishResource;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

class PostPublishController extends ApiController
{

    /**
     * Construct
     */
    public function __construct(Post $post, PostMeta $postMeta, Taxonomy $taxonomy)
    {
        $this->post = $post;
        $this->post_meta = $postMeta;
        $this->taxonomy = $taxonomy;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $idTaxonomy = $request->idTaxonomy ?  $request->idTaxonomy : null;
            if($idTaxonomy){
                $post =  $this->post->where('taxonomy_id', $request->idTaxonomy)->where('id', '!=', $request->id)->get();
                $post->load('taxonomy', 'term');
                return response()->json($post,200);
            }else{
                $limit = $request->limit ?? 10;
                $posts = $this->post->orderBy('created_at', 'DESC')->paginate($limit);
                $posts->load('taxonomy', 'term');
                return response()->json($posts,200);
            }
           
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $post = $this->post->findOrFail($id);
            $post->load('taxonomy', 'term');
            return response()->json($post, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function relation(Request $request, $id)
    {
        try {
            $limit = $request->limit ?? 4;
            $post = $this->post->findOrFail($id);
            $postMeta = $this->post_meta->where('post_id', $post->id)->with('post')->paginate($limit);
            return new PostPublishResource($postMeta);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function category(Request $request, $id)
    {
        try {
            $limit = $request->limit ?? 0;
            $post = $this->post->findOrFail($id);
            $category = $this->taxonomy->where('id', $post->taxonomy_id)->with('posts')->paginate($limit);
            return new PostPublishResource($category);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
