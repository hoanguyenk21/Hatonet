<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publish\CategoryPublishResource;
use App\Models\Post;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

class   CategoryPublishController extends Controller
{
    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }
    public function index(Request $request)
    {
        $limit = $request->limit ?? 5;
        $taxonomy =  $this->taxonomy->where('parent', '!=', -1)->orderBy('id', 'DESC')->paginate($limit);
        $taxonomy->load('posts');
        $taxonomy = $this->taxonomyTranform($taxonomy);
        return response()->json($taxonomy, 201);
        // return new TaxonomyResource(Taxonomy::paginate(25));
    }
    private function taxonomyTranform($taxonomy)
    {
        $taxonomyToReturn = [];
        foreach ($taxonomy as $term) {
            $post_count = Post::where('taxonomy_id', $term->id)->count();
            $item = [
                'id' => $term->id,
                'title' => $term->title,
                'description' => $term->description,
                'content' => $term->content,
                'slug' => $term->slug,
                'parent' => $term->parent,
                'user_id' => $term->user_id,
                'type' => $term->type,
                'product' => $term->product,
                'posts' => $term->posts,
                'post_count' => $post_count
            ];
            array_push($taxonomyToReturn, $item);
        }
        return $taxonomyToReturn;
    }
    public function show($id)
    {
        try {
            $category = $this->taxonomy->findOrFail($id);
            $category->load('posts');
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
