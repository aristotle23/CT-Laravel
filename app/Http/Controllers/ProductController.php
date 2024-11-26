<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\services\ProductServices;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(public ProductServices $productServices)
    {

    }
    public function index(): View
    {
        return view("welcome",$this->productServices->index());

    }
    public function store(StoreProductRequest $request)
    {
        $this->productServices->store($request->only(["name","quantity","price"]));
        return Redirect::to('/');
    }
}
