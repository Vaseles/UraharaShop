<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'avatar' => '/files/users/'.$this->name.'/'.$this->image,
            'bio' => $this->bio,
            'createdAccount' => $this->created_at->format('Y-m-d'),
            
            'products' => ProductResource::collection($this->products),
            'orders' => $this->orders,
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
