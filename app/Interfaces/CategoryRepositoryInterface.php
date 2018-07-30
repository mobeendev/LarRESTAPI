<?php

namespace App\Interfaces;

use App\Category;

interface CategoryRepositoryInterface {

    /**
     * Returns products list
     *
     * @return mixed
     */
    public function all();

    /**
     * Get the product by id
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create new product with the payload.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Updates old category with new category data
     *
     * @param Category $category
     * @param array $data
     * @return mixed
     */
    public function update(Category $category, array $data);

    /**
     * Deletes a Category field and detaches all relations
     * @param int $id
     * @return boolean
     */
    public function delete($id);

    /**
     * Returns a Category with all relations/products that are related to the given category
     *
     * @param int $id
     * @return mixed
     */
    public function categorytWithProducts($id);
}
