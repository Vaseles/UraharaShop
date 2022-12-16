<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index($slug) {
        $product = Product::where('slug', $slug)->first();
        $comments = Comment::where('product_id', $product->id)->first();
        
        if ($product) {
            return response([
                'comments' => $comments,
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
    public function create(CommentRequest $request,$slug) {
        $product = Product::where('slug', $slug)->first();
        $user = Auth::user();
        
        if ($product) {
            $request->validated($request->all());

            $image = $request->image;

            if ($image) {
                $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension();
            } else {
                $imageName = '';
            }

            $comment = Comment::create([
                'product_id' => $product->id,
                'user_id' => $user->id,

                'raiting' => $request->raiting,
                'body' => $request->body,
                'image' => $imageName,
            ]);

            if ($image) {
                $path = public_path('files/products/'.$product->title.'/comments/'.$comment->user->name); 
                $image -> move($path, $imageName);
            }

            return response([
                'status' => 'success',
                'comment' => $comment,
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
    public function show($slug, $id) {
        $product = Product::where('slug', $slug)->first();
        $comment = Comment::where('id', $id)->first();
        
        if ($product) {
            if ($comment) {
                return response([
                    'comments' => $comment,
                ]);
            }
            return response([
                'status' => 'error',
                'message' => 'Comment not found',
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
    public function update(CommentRequest $request, $slug, $id) {
        $product = Product::where('slug', $slug)->first();
        $comment = Comment::where('id', $id)->first();
        
        if ($product) {
            if ($comment) {
                $request->validated($request->all());

                $image = $request->image;

            if ($image) {
                $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension();
            } else {
                $imageName = '';
            }

            $comment = Comment::create([
                'raiting' => $request->raiting,
                'body' => $request->body,
                'image' => $imageName,
            ]);
            $comment->raiting = $request->raiting;
            $comment->body = $request->body;
            $comment->image = $imageName;

            if ($image) {
                $path = public_path('files/products/'.$product->title.'/comments/'.$comment->user->name); 
                $image -> move($path, $imageName);
            }

            return response([
                'status' => 'success',
                'comment' => $comment,
            ]);
            }
            return response([
                'status' => 'error',
                'message' => 'Comment not found',
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
    public function delete($slug, $id) {
        $product = Product::where('slug', $slug)->first();
        $comment = Comment::where('id', $id)->first();
        $comments = Comment::where('product_id', $product->id)->first();
        
        if ($product) {
            if ($comment) {
                $comment -> delete();

                return redirect('/api/v1/products/'.$slug.'/comments');
            }
            return response([
                'status' => 'error',
                'message' => 'Comment not found',
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }
}
