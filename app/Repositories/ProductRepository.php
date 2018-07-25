<?php

namespace App\Repositories;

use App\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    public function all() {
        return Product::all();
    }

    public function find($id) {
        return Product::find($id);
    }

    public function create(array $data) {

        $product = Product::create($data);

        if (isset($data['size']) && isset($data['color'])) {
            $product->categories()->attach($data['category_id'], [
                'size' => $data['size'], 'color' => $data['color']]);
        }

        return $product;
    }

    public function update(Product $product, array $data) {
        
        $product->categories()->detach();

        $product->update($data);

        if (isset($data['size']) && isset($data['color'])) {
            $product->categories()->attach($data['category_id'], [
                'size' => $data['size'], 'color' => $data['color']]);
        }
        return $product;
    }

    public function productWithCategories($id) {
        return Product::with('categories')->where('id', $id)->get()->first()->toArray();
    }

    public function delete($id) {
        
    }

}
