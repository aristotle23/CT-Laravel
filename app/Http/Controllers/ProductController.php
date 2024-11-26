<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        dd( $request->all());

    }
}
