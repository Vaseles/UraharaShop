<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user' => $this->user->name,
            'email' => $this->user->email,
            'product' => [
                'id' => $this->product->id,
                'title' => $this->product->title,
                'slug' => $this->product->slug,
                'image' => '/files/products/'.$this->product->title.'/'.$this->product->image,
                'price' => $this->product->price.'$',
            ],
            'phone' => $this->phone,
            'place of delivery' => [
                'country' => $this->country,
                'city' => $this->city,
                'address' => $this->address,
                'postalCode' => $this->postalCode,
            ],

            'product price' => $this->product->price.'$',
            'count' => $this->count,
            'shippingPrice' => $this->shippingPrice.'$',
            '-------------------------',
            'totalPrice' => $this->totalPrice.'$',
            '-------------------------',

            'isPaid' => $this->isPaid,
            'isDeliver' => $this->isDeliver,    

            'created' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
