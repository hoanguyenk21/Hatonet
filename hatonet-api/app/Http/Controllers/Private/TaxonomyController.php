<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Taxonomy\StoreTaxonomyRequest;
use App\Http\Requests\Taxonomy\UpdateTaxonomyRequest;
use App\Http\Resources\Private\TaxonomyResource;
use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TaxonomyController extends ApiController
{

    /**
     * Construct
     */
    public function __construct(Taxonomy $taxonomy , Post $post)
    {
        $this->taxonomy = $taxonomy;
        $this->post = $post;
    }

    /**
     * create ticket
     *
     * @return \Illuminate\Http\Response
     */
    public function createTicket(StoreTaxonomyRequest $request)
    {
        $data = Arr::add($request->all(), 'type', Taxonomy::TAXONOMY_TYPE['TICKET']);

        return new TaxonomyResource($this->taxonomy->create($data));
    }
    /**
     * create ticket
     *
     * @return \Illuminate\Http\Response
     */
    public function createProduct(StoreTaxonomyRequest $request)
    {
        $category = Arr::add($request->all(), 'type', Taxonomy::TAXONOMY_TYPE['PRODUCT']);
        // set category
        // $data = Arr::add($category, 'user_id', Auth::user()->id);

        // return new TaxonomyResource($this->taxonomy->create($data));
    }

    /**
     * create post
     *
     * @return \Illuminate\Http\Response
     */
    public function createCategory(StoreTaxonomyRequest $request)
    {
        try {
            $category = Arr::add($request->all(), 'type', Taxonomy::TAXONOMY_TYPE['POST']);
            $data = Arr::add($category, 'user_id', Auth::user()->id);
            $resp = $this->taxonomy->create($data);
            return response()->json($resp, 200);
        } catch (\Throwable$th) {
            throw $th;
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxonomy = Taxonomy::orderBy('id', 'DESC')->get();
        $taxonomy =  $taxonomy->map(function ($query)
        {
            $query->count_taxonomy = $query->posts->count() ?? 0;
            return $query;
        });
        return response($taxonomy, 201);
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
     * @param  \App\Http\Requests\StoreTaxonomyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxonomyRequest $request)
    {
        $taxonomy = new Taxonomy;
        $taxonomy = Taxonomy::create($request->all());
        $taxonomy->save();
        return response($taxonomy , 200);
        // return new TaxonomyResource($this->taxonomy->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // return new TaxonomyResource($this->taxonomy->findOrFail($taxonomy));
            $taxonomy = $this->taxonomy->findOrFail($id);
            $taxonomy->load('posts');
            return response($taxonomy , 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxonomyRequest  $request
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxonomyRequest $request, $id)
    {
        try {
            $taxo = Taxonomy::find($id);
            $taxo->update($request->all());
            return response($taxo, 200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $idCategory = Taxonomy::where('parent' ,'-1')->get();
            foreach ($idCategory as $post) {
                $idCate = $post->id;     
            }
            $taxonomy = $this->taxonomy->findOrFail($id);    
            $taxonomyPost = $taxonomy->posts;
            if ($taxonomyPost->count()) {
                foreach ($taxonomyPost as $post) {
                    $post->taxonomy_id = $idCate;
                    $post->save();
                }
            }
            $deleted = $taxonomy->delete();
            $taxonomy->destroy($id);
            return \response()->json($deleted);
        } catch (\Throwable$th) {
            return response()->json(['message' => $th], 403);
        }
    }
}
