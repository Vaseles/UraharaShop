<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() { //! all categories
        return response([
            'categories' => Category::all(), 
        ]);
    }

    public function create(Request $request) {
        
        if (Category::where('name', $request->name)->first()) { //! CHECK IF CATEGORY HAS BEEN CREATED
            return response([
                'status' => 'error',
                'message' => 'Category has been created',
            ]);
        }
        $category = Category::create([ //! CREATE NEW CATEGORY
            'name' => $request->name,
        ]);

        return response([
            'status' =>'success',
            'category' => $category,
        ]);
    }

    public function show($name) {
        $category = Category::where('name', $name)->first();

        if ($category) { //! OUTPUT CATEGORY
            return response([
                'category' => $category
            ]);
        }
        return response([
           'status' => 'error',
          'message' => 'Category not found',
        ]);
    }
    public function delete($name) {
        $category = Category::where('name', $name)->first();

        if ($category) { //! DELETE CATEGORY
            $category->delete();
            return response([
               'status' =>'success',
               'message' => 'Category deleted successfully',
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Category not found',
        ]);
    }
}
