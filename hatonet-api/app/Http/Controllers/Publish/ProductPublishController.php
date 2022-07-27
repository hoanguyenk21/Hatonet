<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Publish\ProductPublishResource;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\Taxonomy;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductPublishController extends ApiController
{
    public function __construct(ProductMeta $productMeta, Product $product, Rating $rating)
    {
        $this->product = $product;
        $this->rating = $rating;
        $this->product_meta = $productMeta;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $province = $request->province;
            $skill = $request->skill;
            $keyword = $request->keyword;
            $idUser = $request->idUser;
            if (isset($idUser)) {
                $jobsRelated = $this->product->where('user_id', $request->idUser)->where('id', '!=', $request->id)->get();
                $jobsRelated->load('taxonomy', 'term', 'user');
                return response()->json($jobsRelated);
            }
            if (empty($province) && empty($skill) && empty($keyword)) {
                $product = $this->product->All();
                $product->load('productMeta', 'term', 'user');
                return response($product, 200);
            }
            $result = [];
            if (!empty($keyword)) {
                $result = $this->product->where('title', 'LIKE', '%' . $keyword . '%')->get();
            }
            if (!empty($province)) {
                $result = $this->product->whereHas('productMeta', function (Builder $query) use ($province) {
                    $query->where('meta_key', '_address')->where('meta_value', $province);
                })->get();
            }
            if (!empty($skill)) {
                $result = $this->product->whereHas('productMeta', function (Builder $query) use ($skill) {
                    $query->where('meta_key', '_skill')->where('meta_value', $skill);
                })->get();
            }
            $result->load('productMeta', 'term', 'user');
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message' => _("messages.not_content")], 403);
        }
    }


    public function show($id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->load('reviews', 'user');
            $productMeta = [];

            foreach ($product->productMeta as $key => $item) {
                $metaKey = $item['meta_key'];
                $metaValue = json_decode($item['meta_value']);
                $productMeta[$metaKey] = $metaValue;
            }
            $productMeta = (object) $productMeta;
            return response()->json([
                'product' => $product,
                'meta' => $productMeta,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function relation(Request $request, $id)
    {
        try {
            $limit = $request->limit ?? 4;
            $product = $this->product->find($id);
            $taxonomy = Taxonomy::where('id', $product->taxonomy_id)->with('product')->paginate($limit);
            return new ProductPublishResource($taxonomy);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function category(Request $request, $id)
    {
        $limit = $request->limit ?? 4;
        $taxonomy = Taxonomy::where('id', $id)->with('product')->paginate($limit);
        return new ProductPublishResource($taxonomy);
    }

    public function getDownload()
    {
        $file = public_path() . "/download/phan.pdf";
        return response()->download($file);
    }
}
