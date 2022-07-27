<?php

namespace App\Http\Resources\Private;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'paginate' => [
                'total' => $this->total(),
                'totalPage' => ceil($this->total() / $this->perPage()),
                'current' => $this->currentPage(),
            ],
            'items' => $this->collect(),
        ];
    }
}
