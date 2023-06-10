<?php

namespace App\Http\Controllers\Api\v1;
use App\Models\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return response()->json($categories);
    }
}
