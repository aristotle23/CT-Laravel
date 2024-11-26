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
        $fileExists = Storage::disk("local")->exists($this->fileName);
        $products = $fileExists ? $this->getFileProducts() : $this->writeProductsToFile(collect([]));
        $total = $products->sum("total_value");
        return ["products" => $products->sortByDesc("date_time"),"total" => $total];
    }

    public function store(array $request): void
    {
        if(!empty($request["product_id"])) {
            $this->editProduct($request);
            return;
        }
        $products = $this->getFileProducts();
        $request["id"] = $this->incrementId($products);
        $request["date_time"] = date("Y-m-d h:i:s");
        $request["total_value"] = $request["quantity"] * $request["price"];
        $products->push($request);
        $this->writeProductsToFile($products);
    }
    public  function editProduct(array $request): void {
        $products = $this->getFileProducts();
        $editedProducts = $products->map(function ($item, int $key) use($request){
            if($item->id == $request["product_id"]){
                $item->name =  $request["name"];
                $item->quantity = $request["quantity"];
                $item->price = $request["price"];
                $item->total_value = $request["quantity"] * $request["price"];
            }
            return $item;
        });
        $this->writeProductsToFile($editedProducts);
    }

    private function incrementId(Collection $products): int
    {
        $lastProduct = $products->last();
        if(is_null($lastProduct)) return 1;
        return $lastProduct->id + 1;
    }

    private function getFileProducts(): Collection
    {
        $path = Storage::disk("local")->path($this->fileName);
        $products = json_decode(File::get($path));
        return collect($products);
    }

    private function writeProductsToFile(Collection $products): Collection
    {
        Storage::disk("local")->put($this->fileName, json_encode($products));
        return $products;
    }
}
