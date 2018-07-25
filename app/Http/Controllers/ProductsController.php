<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ProductsController extends BaseController {

    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepo = $productRepository;
    }

    public function index() {

        $products = $this->productRepo->all();

        return $this->sendResponse('Products retrieved successfully.', $products->toArray());
    }

    public function show($id) {

        $product = $this->productRepo->find($id);

        if ($product != null) {

            $productDetails = $this->productRepo->productWithCategories($product->id);

            return $this->sendResponse('Product retrieved successfully.', $productDetails);
        }
        return $this->sendError('Product not found!');
    }

    public function store(Request $request) {

        $input = $request->all();

        $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:products|max:255',
                    'description' => 'required',
                    'price' => 'integer',
                    'availability' => 'boolean',
                    'category_id' => 'integer',
                    'size' => 'string',
                    'color' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Errors', $validator->errors());
        }

        $product = $this->productRepo->create($input);

        return $this->sendResponse($product->toArray(), 'Product created successfully.');
    }

    public function update(Request $request, $id) {

        $input = $request->all();
        $product = $this->productRepo->find($id);

        if ($product == null) {
            return $this->sendError('Error', "Product not found!");
        }

        $validator = Validator::make($request->all(), [
                    'title' => 'required|unique:products|max:255',
                    'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error', $validator->errors());
        }

        $product = $this->productRepo->update($product, $input);

        $productDetails = $this->productRepo->productWithCategories($product->id);

        return $this->sendResponse($productDetails, 'Product updated successfully.');
    }

    public function delete($id) {
        $product = $this->productRepo->find($id);

        if ($product == null) {
            return $this->sendError('Product not found!');
        }
        $product->delete();
        return $this->sendResponse('Product deleted successfully.');
    }

}
