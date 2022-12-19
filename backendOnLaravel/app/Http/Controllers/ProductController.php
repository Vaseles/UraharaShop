<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request) {
        // $paginator = Product::paginate(10); //! PAGINATOR
        // return response([
        //     'page' => $paginator->currentPage(),
        //     'pageElementsCount' => $paginator->count(),
        //     'productsCount' => Product::count(),
        //     'products' => ProductResource::collection($paginator->items()), 
        // ]);

        $sortField = 'title';
        $sortReverse = 'asc';

        // //! SORT REVERSE 
        // if ($request->sortDesc == 'desc') {
        //     $sortReverse = 'desc';
        // }
        // //! SORT FIELD(TITLE/CATEGORY/price/created/raiting/price/user)
        // if ($request->sortField == 'category') {
        //     $sortField = 'category';
        // }
        // if ($request->sortField == 'price') {
        //     $sortField = 'price';
        // }
        // if ($request->sortField == 'desc') {
        //     $sortField = 'description';
        // }
        // if ($request->sortField == 'created') {
        //     $sortField = 'created';
        // }
        // if ($request->sortField == 'raiting') {
        //     $sortField = 'raiting';
        // }
        // if ($request->sortField == 'user') {
        //     $sortField = 'user';
        // }
        
        $products = Product::orderBy($sortField, $sortReverse)->get();

        return response([
            'productsCount' => Product::count(),
            // 'products' => ProductResource::collection(Product::all()),
            'products' => ProductResource::collection($products),
        ]);
    }

    public function create(ProductRequest $request) { //! CREATE 
        $request->validated($request->all());

        $slug = implode('-', explode(' ', strtolower($request->title)));
        if (Product::where('slug', $slug)->first()) { //! if slug has been get
            return response([
                'status' => 'error',
                'message' => 'Slug already exists',
            ], 400);
        }

        $user = Auth::user();

        $image = $request->image;
        $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension(); //! create name

        $product = Product::create([ //! create new product
            'title' => $request->title,
            'slug' => $slug,
            'image' =>  $imageName,
            'description' => $request->description,
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'raiting' => '0',
            'count' => $request->count,
            'price' => $request->price,
        ]);

        $path = public_path('files/products/'.$product->title); //! GET PATH
        $image->move($path, $imageName);

        return response([
            'status' => 'success',
            'product' => $product,
        ]);
    }

    public function show($slug) {
        $product = Product::where('slug', $slug)->first(); //! GET PRODUCT

        if ($product) {
            return response([
                'product' => new ProductResource($product),
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }

    public function update(ProductRequest $request, $slug) { //! UPDATE
        $product = Product::where('slug', $slug)->first(); //! GET PRODUCT
        $user = Auth::user();

        if ($product) {
            if ($product->id == $user->id) {
                $request->validated($request->all());

                $product->title = $request->title;

                $slug = implode('-', explode(' ', strtolower($request->title)));
                if (Product::where('slug', $slug)->first()) { //! if slug has been get
                    return response([
                        'status' => 'error',
                        'message' => 'Slug already exists',
                    ], 400);
                }
                $product->slug = $request->slug;

                $image = $request->image;
                $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension(); //! create name

                $product->image = $request->image;

                $path = public_path('files/products/'.$product->title); //! GET PATH
                $image->move($path, $imageName);

                $product->description = $request->description;
                $product->category_id = $request->category_id;
                $product->count = $request->count;
                $product->price = $request->price;

                $product->save();
                return response([
                    'status' => 'success',
                    'product' => $product,
                ]);
            }
            return response([
                'status' => 'error',
                'message' => 'This product not found for u'
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }

    public function delete($slug) { //! DELETE
        $product = Product::where('slug', $slug)->first(); //! GET PRODUCT
        $user = Auth::user();

        if ($product) {
            if ($product->id == $user->id) {
                $product->delete(); //! DELETE PRODUCT

                return redirect('/api/v1/products');
            }
            return response([
               'status' => 'error',
               'message' => 'This product not found for u'
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
}
