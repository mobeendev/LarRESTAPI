<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController {

    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepo = $categoryRepository;
    }

    public function index() {

        $categories = $this->categoryRepo->all();

        return $this->sendResponse('Categories retrieved successfully.', $categories->toArray());
    }

    public function show($id) {

        $category = $this->categoryRepo->find($id);

        if ($category != null) {

            $categoryDetails = $this->categoryRepo->categorytWithProducts($category->id);

            return $this->sendResponse('Category retrieved successfully.', $categoryDetails);
        }
        return $this->sendError('Category not found!');
    }

    public function store(Request $request) {

        $input = $request->all();
     
        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:categories|max:255',
                    'sub_category_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Errors', $validator->errors());
        }

        $category = $this->categoryRepo->create($input);

        return $this->sendResponse('Category created successfully.' , $category->toArray());
    }

    public function update(Request $request, $id) {

        $input = $request->all();
        $category = $this->categoryRepo->find($id);

        if ($category == null) {
            return $this->sendError('Error', "Category not found!");
        }

        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:categories|max:255',
                    'sub_category_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error', $validator->errors());
        }

        $category = $this->categoryRepo->update($category, $input);
        
        $categoryDetails = $this->categoryRepo->categorytWithProducts($category->id);

        return $this->sendResponse($categoryDetails, 'Product updated successfully.');
    }

    public function delete($id) {
        $category = $this->categoryRepo->find($id);

        if ($category == null) {
            return $this->sendError('Category not found!');
        }
        $category->delete();
        return $this->sendResponse('Category deleted successfully.');
    }

}
