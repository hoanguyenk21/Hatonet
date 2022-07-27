<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Term;

class TermPublishController extends Controller
{
    public function __construct(Term $term)
    {
        $this->term = $term;
    }

    public function index()
    {  
        $term= Term::all();
        $term->load('tag', 'posts');
        return response()->json($term, 200);
        // return new TermResource(Term::paginate(25));
    }

    public function show($id)
    {
        try {
            $term = $this->term->findOrFail($id);
            $term->load('tag', 'posts');
            return response()->json($term,200);
        } catch (\Throwable$th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){
        
    }
}
