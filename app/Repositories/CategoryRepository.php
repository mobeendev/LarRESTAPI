<?php

namespace App\Repositories;

use App\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {

    public function all() {
        return Category::all();
    }

    public function categorytWithProducts($id) {
        return Category::with('products')->where('id', $id)->get()->first()->toArray();
    }

    public function create(array $data) {
        $category = Category::create($data);

        if (isset($data['products']) && isset($data['products'])) {
            $category->products()->attach($data['products']);
        }
        return $category;
    }

    public function delete($id): boolean {
        
    }

    public function find($id) {
        return Category::find($id);
    }

    public function update(Category $category, array $data) {
        $category->products()->detach();

        $category->update($data);

        if (isset($data['products']) && isset($data['products'])) {
            $category->products()->attach($data['products']);
        }
        
        return $category;
    }

}
