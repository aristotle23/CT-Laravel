<?php

namespace App\Http\services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductServices
{
    private $fileName;

    public function __construct()
    {
        $this->fileName = config("app.file_name");
    }

    public function index(): array
    {
        $fileExists = Storage::disk("local")->exists($this->fileName);
        $products = $fileExists ? $this->getFileProducts() : $this->writeProductsToFile([]);
        $total = collect($products)->sum("total_value");
        return ["products" => array_reverse($products),"total" => $total];
    }

    public function store(array $request): void
    {

        $products = $this->getFileProducts();
        $request["id"] = $this->incrementId($products);
        $request["date_time"] = date("Y-m-d h:i:s");
        $request["total_value"] = $request["quantity"] * $request["price"];
        $products[] = $request;
        $this->writeProductsToFile($products);
    }

    private function incrementId(array $productArr): int
    {
        if (count($productArr) < 1) return 1;
        $lastProduct = end($productArr);
        return $lastProduct->id + 1;
    }

    private function getFileProducts(): array
    {

        $path = Storage::disk("local")->path($this->fileName);
        return json_decode(File::get($path));
    }

    private function writeProductsToFile($products): array
    {
        Storage::disk("local")->put($this->fileName, json_encode($products));
        return $products;
    }
}
