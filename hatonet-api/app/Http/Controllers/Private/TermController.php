<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Term\StoreTermsRequest;
use App\Http\Requests\Term\UpdateTermsRequest;
use App\Http\Resources\Private\TermResource;
use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Product;

class TermController extends ApiController
{

     /**
     * Construct
     */
    public function __construct(Term $term)
    {
        $this->term = $term;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $term= Term::orderBy('id', 'DESC')->get();
    //     $term->load('tag');
    //     return response()->json($term, 200);
    //     // return new TermResource(Term::paginate(25));
    // }
    public function index(Request $request)
{
    try {
        $term = $this->term->orderBy('id', 'DESC')->get();
        $term = $term->map(function ($query)
        {
            $query->count_posts = $query->posts->count() ?? 0;
            return $query;
        });

        return response()->json($term,200);
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
     * @param  \App\Http\Requests\StoreTermsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermsRequest $request)
    {
        $terms = new Term;
        $terms= Term::create($request->all());
        $terms->save();
        return response()->json($terms , 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $term = $this->term->findOrFail($id);
            return response()->json($term,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $terms)
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermsRequest  $request
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermsRequest $request, $id)
    {
        try {

            $term = $this->term->findOrFail($id)->update($request->all());
            return response()->json($term,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $term = $this->term->findOrFail($id)->destroy($id);
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
