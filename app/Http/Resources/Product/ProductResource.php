<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'description'=>$this->detail,
            'price'=>$this->price,
            'stock'=>$this->stock == 0 ? 'Out of stock' : $this->stock ,
            'totalPrice'=>round((1-($this->discount)/100)*$this->discount,2),
            'rating'=>$this->reviews->count() ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No rating yet',
            'href'=>[
                'reviews'=> route('reviews.index', $this->id)
            ]
        ];
    }
}
