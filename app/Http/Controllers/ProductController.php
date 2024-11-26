<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\services\ProductServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(public ProductServices $productServices)
    {

    }
    public function index(): View
    {
        return view("welcome",$this->productServices->index());

    }
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productServices->store($request->all());
        return response()->json([
            "status" => true,
            "message" => "Product stored successfully",
            "data" => $product
        ],201);
    }
}
