<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Private\ProductResource;
use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Support\Facades\Auth;
use App\Models\Notify;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(Product $product, ProductMeta $productMeta)
    {
        $this->product = $product;
        $this->product_meta = $productMeta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SearchNumber = $request->SearchNumber  ? $request->SearchNumber : null;
        $SearchStatus = $request->SearchStatus  ? $request->SearchStatus : null;
        $SearchTerm = $request->SearchTerm  ? $request->SearchTerm : null;
        $limit = isset($request->limit) ? $request->limit : 10;
        if (!$SearchNumber && !$SearchStatus && !$SearchTerm) {
            $pro = Product::orderBy('created_at', 'desc')->paginate($limit);
            $pro->load('productMeta', 'term', 'user');
            return response()->json($pro);
        } else if ($SearchNumber) {
            $pro = Product::orderBy('created_at', 'desc')->simplePaginate($request->SearchNumber);
            $pro->load('productMeta', 'term', 'user');
            return response($pro, 201);
        } else if ($SearchStatus) {
            $product = Product::where('status', $SearchStatus)->orderBy('created_at', 'desc')->paginate($limit);
            $product->load('productMeta', 'term', 'user');
            return $product;
        }
        $product =  $this->product_meta->where('_skill', $SearchTerm)->orderBy('created_at', 'desc')->paginate($limit);
        $product->load('productMeta', 'term', 'user');
        return $product;
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $product = $this->product->create($request->all());
            foreach ($request->meta as $key => $value) {
                $this->product_meta->create([
                    'product_id' => $product->id,
                    'meta_key' => ($key),
                    'meta_value' => json_encode($value),
                ]);
            }
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->load('productMeta', 'term', 'user', 'taxonomy');
            $productMeta = [];

            foreach ($product->productMeta as $key => $item) {
                $metaKey = $item['meta_key'];
                $metaValue = json_decode($item['meta_value']);
                $productMeta[$metaKey] = $metaValue;
            }
            $productMeta = (object) $productMeta;
            $product->meta = $productMeta;
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            if (!empty($request->change_status) && json_decode($request->change_status) == true) {
                $product = $this->product->findOrFail($id);
                $product->status = $request->new_status;
                $product->save();
            } else {
                $dataMeta = $request->meta;
                $dataProduct = $request->all();
                unset($dataProduct['id'], $dataProduct['meta'], $dataProduct['product_meta']);
                $product = $this->product->findOrFail($id);
                $product->update($dataProduct);
                $proMeta = $product->productMeta;

                foreach ($dataMeta as $key => $value) {
                    $metaByKey = $proMeta->where('meta_key', $key)->first();
                    $metaByKey->meta_value = json_encode($value);
                    $metaByKey->save();
                }
                return response()->json($product);
            }
            return response($check ?? false);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->product->findOrFail($id)->destroy($id);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            foreach ($request->list as $id) {
                $check = false;
                $product = $this->product->findOrFail($id);
                $product->status = $request->status;
                $product->save();
                $check = true;
            }
            return response($check ?? false);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
}
