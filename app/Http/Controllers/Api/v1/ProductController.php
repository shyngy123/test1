<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\Product\ProductIndexRequest;

class ProductController extends Controller
{
     public function index(ProductIndexRequest $request)
    {

        $data = $request->validated();

        $query = Product::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        $products = $query->get();

        return response()->json($products);
    }
}
