<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($name) {
        $user = Auth::user();
        $User = User::where('name', $name)->first();

        if ($user) {
            if ($User->id == $user->id) {
                $orders = Order::where('user_id', $user->id)->get();

                return response([
                    'ordersCount' => $orders->count(),
                    'orders' => OrderResource::collection($orders),
                ]);
            }
        }
        return response([
            'status' => 'error',
            'message' => 'U need to register ||  login'
        ]);
    }

    public function create(OrderRequest $request, $slug) {
        $product = Product::where('slug', $slug)->first();
        $user = Auth::user();

        if ($product) {
            $request->validated($request->all());

            $count = $request->count;
    
            //TODO: PRICE CALUCALATE
            $beginningPrice = $product->price;
            
            $country = ucfirst($request->country);
            $shippingPrice = 10;

            if ($country == 'USA' || $country == 'Mexico' || $country == 'Canada') {
                $shippingPrice = 14;
            } else if ($country == 'Australia') {
                $shippingPrice = 20;
            } else if ($country == 'Poland' || $country == 'Germany' || $country == 'France' || $country == 'Finland' || $country == 'Italy' || $country == 'Spain' || $country == 'Greece' || $country == 'Latvia' || $country == 'Luxembourg' || $country == 'Ukraine' || $country == 'United Kingdom') {
                $shippingPrice = 6;
            } else if ($country == 'Israel') {
                $shippingPrice = 8;
            } else if ($country == 'Japan' || $country == 'Kazakhstan' || $country == 'China' || $country == 'South Korea') {
                $shippingPrice = 22;
            } else {
                $shippingPrice = 30;
            }

            $totalPrice = $beginningPrice*$count + $shippingPrice;


            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,

                'phone' => $request->phone,
                'count' => $count,

                'country' => $country,
                'city' => $request->city,
                'address' => $request->address,
                'postalCode' => $request->postalCode,

                'payMethod' => $request->payMethod,
                'shippingPrice' => $shippingPrice,
                'totalPrice' => $totalPrice,

                'isPaid' => 'false',
                'isDeliver' => 'false',
            ]);

            return response([
                'status' => 'success',
                'order' => new OrderResource($order),
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Product not found',
        ]);
    }

    public function show($name, $id) {
        $user = Auth::user();
        $User = User::where('name', $name)->first();

        if ($user) {
            if ($User->id == $user->id) {
                $order = Order::where('id', $id)->where('user_id', $user->id)->first();

                if ($order) {
                    return response([
                        'order' => new OrderResource($order),
                    ]);
                } 
                return response([
                   'status' => 'error',
                   'message' => 'order not found',
                ]);
            }
        }
        return response([
            'status' => 'error',
            'message' => 'U need to register ||  login'
        ]);
    }

    public function paid(Request $request, $name, $id) {
        $user = Auth::user();
        $User = User::where('name', $name)->first();

        if ($user) {
            if ($User->id == $user->id) {
                $order = Order::where('id', $id)->where('user_id', $user->id)->first();

                if ($order) {
                    //TODO: ____PLACE FOR INCLUDE PAYMENT____

                    if ($order->isPaid == 'false') {
                        $order->isPaid = 'true'; //! I just doing it
                        $order->save();
                    }

                    // return redirect('/api/v1/user/'.$user->name.'/orders/.$order->id');
                    return response([
                       'status' =>'success',
                        'order' => new OrderResource($order),
                    ]);
                } 
                return response([
                   'status' => 'error',
                   'message' => 'order not found',
                ]);
            }
        }
        return response([
            'status' => 'error',
            'message' => 'U need to register ||  login'
        ]);
    }
    public function deliver(Request $request, $name, $id) {
        $user = Auth::user();
        $User = User::where('name', $name)->first();

        if ($user) {
            if ($User->id == $user->id) {
                $order = Order::where('id', $id)->where('user_id', $user->id)->first();
                

                if ($order) {
                    //TODO: ____PLACE FOR INCLUDE PAYMENT____

                    if ($order->isDeliver == 'false') {
                        $order->isDeliver = 'true'; //! I just doing it
                        $order->save();
                    }

                    // return redirect('/api/v1/user/'.$user->name.'/orders/.$order->id');
                    return response([
                        'status' =>'success',
                         'order' => new OrderResource($order),
                     ]);
                } 
                return response([
                   'status' => 'error',
                   'message' => 'order not found',
                ]);
            }
        }
        return response([
            'status' => 'error',
            'message' => 'U need to register ||  login'
        ]);
    }
}
