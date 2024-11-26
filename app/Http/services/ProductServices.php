<?php

namespace App\Http\services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductServices
{
    private string $fileName;

    public function __construct()
    {
        $this->fileName = config("app.file_name");
    }

    public function index(): array
    {
        $products = $this->getFileProducts();
        $total = $products->sum("total_value");
        return ["products" => $products->sortByDesc("date_time"),"total" => $total];
    }

    public function store(array $request): mixed
    {
        if(!empty($request["product_id"])) {
            return $this->editProduct($request);
        }
        $products = $this->getFileProducts();
        $request["id"] = $this->incrementId($products);
        $request["date_time"] = date("Y-m-d h:i:s");
        $request["total_value"] = $request["quantity"] * $request["price"];
        $products->push($request);
        $this->writeProductsToFile($products);
        return $request;
    }
    public  function editProduct(array $request): mixed {
        $products = $this->getFileProducts();

        $index = $products->search(function($item , int $key) use($request){
            return $item->id == $request["product_id"];
        });

        $item = $products[$index];
        $item->name =  $request["name"];
        $item->quantity = $request["quantity"];
        $item->price = $request["price"];
        $item->total_value = $request["quantity"] * $request["price"];
        $item->product_id = $request["product_id"];

        $products[$index] = $item;

        $this->writeProductsToFile($products);

        return $item;
    }

    private function incrementId(Collection $products): int
    {
        $lastProduct = $products->last();
        if(is_null($lastProduct)) return 1;
        return $lastProduct->id + 1;
    }

    private function getFileProducts(): Collection
    {
        $products = collect();
        if(Storage::disk("local")->exists($this->fileName)){
            $path = Storage::disk("local")->path($this->fileName);
            $products = collect(json_decode(File::get($path)));
        }
        return $products;
    }

    private function writeProductsToFile(Collection $products): Collection
    {
        Storage::disk("local")->put($this->fileName, json_encode($products));
        return $products;
    }
}
