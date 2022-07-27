<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Private\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\User;
class PostController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
            $keyword = $request->search  ? $request->search : null ;
            $number = $request->number  ? $request->number : null ;
            $limit = isset($request->limit) ? $request->limit : 10;
            $postType = isset($request->type) ? $request->type : "";
            // search
            if(!$keyword && !$number) {
                $post = Post::where('type' , $postType)
                ->orderBy('created_at' , 'desc')
                ->with('taxonomy', 'term','user')
                ->paginate($limit);     
                return response()->json($post,200);   
            }else if($number){
                $post = Post::where('type' , $postType)
                ->orderBy('created_at' , 'desc')
                ->with('taxonomy', 'term','user')
                ->simplePaginate($number);  
                return response($post, 201);
            }else{
                $post = Post::where('type' , $postType)
                ->Where('title', 'like' , '%'.$keyword.'%')
                ->orderBy('created_at' , 'desc')
                ->with('taxonomy', 'term','user')
                ->paginate();
                return response()->json($post,200);
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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try{
       $post = new Post;
       $post = Post::create($request->all());
        if($request->has('image') && !empty($request->image)){
                $imageName = time() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path('images/') , $imageName);
                $path = ('/images/' .$imageName);
                $post->image = $path;
                $post->thumbnail = $path;
        }else{
            $post->image = '/images/imagesav.png';
            $post->thumbnail = '/images/imagesav.png';
        }
       $post->save();
       return response()->json($post , 200);
             
    } catch (\Throwable $th) {
        return response()->json(['message' => __("messages.not_content")], 403);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = $this->post->findOrFail($id);
            return response()->json($post,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $post = $this->post->findOrFail($id);  
            $post->update($request->all());
            if($request->has('image') && !empty($request->image)){
                $imageName = time() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path('images/') , $imageName);
                $path = ('/images/' .$imageName);
                $post->image = $path;
                $post->thumbnail = $path;
                $post->save();
            }else{
                $post->image = '/images/imagesav.png';
                $post->thumbnail = '/images/imagesav.png';
            }  
            return response()->json($post,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => $th], 403);
        }
    }
    // public function uploadImage(Request $request){
    //      dd(1);
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    { 
        try {
                $post = $this->post->destroy(explode(",", $id));
            return response()->json($post, 200);   
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }

    }    
    public function updateView(Post $post){
        $post->view += 1;
        $post->save();
        return response()->json($post);
    }
}
