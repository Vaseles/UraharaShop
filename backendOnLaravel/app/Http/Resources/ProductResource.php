<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $raiting = '';

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => '/files/products/'.$this->title.'/'.$this->image,
            'description' => $this->description,

            'user' => $this->user->name,
            'category' => $this->category->name,

            'raiting' => $raiting,
            'count' => $this->count,
            'price' => $this->price.'$',
            'created' => $this->created_at->format('Y-m-d H:i:s'),
            'updated' => $this->updated_at->format('Y-m-d H:i:s'),

            'comments' => CommentResource::collection($this->comments),
            // 'comments' => $this->comments,
            'oreders' => $this->oreders,
        ];
    }
}
