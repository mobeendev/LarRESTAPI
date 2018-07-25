<?php

namespace App\Interfaces;

use App\Product;

interface ProductRepositoryInterface {

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
     * Updates old product with new product data
     *
     * @param Product $product
     * @param array $data
     * @return mixed
     */
    public function update(Product $product, array $data);

    /**
     * Deletes a Product field and detaches all relations
     * @param int $id
     * @return boolean
     */
    public function delete($id);

    /**
     * Returns a product with all relations/categories that are related to the given product id
     *
     * @param int $id
     * @return mixed
     */
    public function productWithCategories($id);
}
